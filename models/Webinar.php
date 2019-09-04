<?php

namespace app\models;

use app\helpers\CustomHelper;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "webinar".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $video
 * @property int $manager_id
 * @property int $status_id
 * @property int $arrangement
 * @property int $type_f
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryWebinar[] $categoryWebinars
 * @property Manager $manager
 * @property Type $typeF
 * @property string $type
 * @property UploadedFile $download
 * @property array $categories
 * @property array $checkedIds
 */
class Webinar extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $download;

    /**
     * @return array
     */
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
        return 'webinar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'content', 'video'], 'string'],
            [['manager_id', 'status_id', 'arrangement', 'type_f', 'created_at', 'updated_at'], 'integer'],
            [['download'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4', 'maxSize' => CustomHelper::getSizeLimitBytes()],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['manager_id' => 'id']],
            [['type_f'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_f' => 'id']],
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
            'content' => 'Content',
            'video' => 'Video',
            'manager_id' => 'Manager ID',
            'status_id' => 'Status ID',
            'arrangement' => 'Arrangement',
            'type_f' => 'Type F',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryWebinars()
    {
        return $this->hasMany(CategoryWebinar::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeF()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_f']);
    }
    public function getType() {
        return $this->getTypeF()->one()->attributes['db_name'];
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
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getManagers() {
        return Manager::find()
            ->indexBy('id')
            ->all();
    }

    public function getCategories() {
        return Category::find()
            ->indexBy('id')
            ->all();
    }

    public function getCheckedIds() {
        $rawArray = $this->getCategoryWebinars()->all();
        $checkedIds = [];
        foreach ($rawArray as $row) {
            $checkedIds[] = $row->attributes['parent_id'];
        }
        return $checkedIds;
    }

    public function saveCheckedIds($checkedIds) {
        if ($checkedIds) {
            $model = CategoryWebinar::find();
            $oldArray = $model
                ->where('unit_id = ' . $this->id)
                ->all();
            foreach ($oldArray as $row) {
                $row->delete();
            }
            foreach ($checkedIds as $catid) {
                $m= new CategoryWebinar();
                $m->unit_id = $this->id;
                $m->parent_id = $catid;
                $m->save();
            }

            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->download) {
            $baseName = Yii::$app->transliter->translate($this->download->baseName) . '_' . rand(0, 99);

            $this->download->saveAs('webinars/' . $baseName  . '.' . $this->download->extension);
            return $baseName  . '.' . $this->download->extension;
        } else {
            return false;
        }
    }
}
