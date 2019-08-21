<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paperissue".
 *
 * @property int $id
 * @property string $title
 * @property string $document
 * @property int $month_f
 * @property int $year_f
 * @property string $base_url
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PaperYear $yearF
 * @property PaperissueTie[] $paperissueTies
 */
class Paperissue extends \yii\db\ActiveRecord
{
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
            [['title', 'document', 'month_f', 'year_f'], 'required'],
            [['title', 'document'], 'string'],
            [['month_f', 'year_f', 'created_at', 'updated_at'], 'integer'],
            [['base_url'], 'string', 'max' => 30],
            [['year_f'], 'exist', 'skipOnError' => true, 'targetClass' => PaperYear::className(), 'targetAttribute' => ['year_f' => 'year_f']],
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
            'base_url' => 'Base Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearF()
    {
        return $this->hasOne(PaperYear::className(), ['year_f' => 'year_f']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaperissueTies()
    {
        return $this->hasMany(PaperissueTie::className(), ['unit_id' => 'id']);
    }
}
