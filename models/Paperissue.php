<?php

namespace app\models;

use app\helpers\CustomHelper;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "paperissue".
 *
 * @property int $id
 * @property string $title
 * @property string $document
 * @property int $month_f
 * @property int $year_f
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Paperyear $yearF
 * @property UploadedFile $download
 * @property array $months
 */
class Paperissue extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $download;

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paperissue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'month_f', 'year_f'], 'required'],
            [['title', 'document'], 'string'],
            [['download'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, doc, docx, rtf', 'maxSize' => CustomHelper::getSizeLimitBytes()],
            [['month_f', 'created_at', 'updated_at'], 'integer'],
            [['year_f'], 'validateYear'],
            [['year_f'], 'exist', 'skipOnError' => true, 'targetClass' => Paperyear::className(), 'targetAttribute' => ['year_f' => 'year_f']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'document' => 'Document',
            'month_f' => 'Month F',
            'year_f' => 'Year F',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearF()
    {
        return $this->hasOne(Paperyear::className(), ['year_f' => 'year_f']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(Paper::className(), ['id' => 'paper_id']);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDatetime($this->updated_at,'php:d.m.Y');
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->download) {
            $baseName = Yii::$app->transliter->translate($this->download->baseName) . '_' . rand(0, 99);

            $this->download->saveAs('papers/' . $baseName  . '.' . $this->download->extension);
            return $baseName  . '.' . $this->download->extension;
        } else {
            return false;
        }
    }

    public function getMonths() {
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = ['id' => $i, 'title' => $i];
        }
        return $months;
    }

    public function validateYear($year)
    {
        if(!preg_match('/^20\d{2}$/', $this->$year)){
            $this->addError($year, 'Год должен начинаться с "20".');
        }
        else {
            $years = \yii::$app->db->createCommand("SELECT year_f FROM paper_year ORDER BY year_f DESC")->queryAll();
            if (!in_array($this->$year, $years)) {
                \yii::$app->db->createCommand("INSERT INTO paper_year (year_f) VALUES (" . $this->$year . ")")->execute();
            }
        }
    }
}
