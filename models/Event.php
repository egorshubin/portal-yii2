<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $document
 * @property int $manager_id
 * @property int $status_id
 * @property int $arrangement
 * @property int $type_f
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryEvent[] $categoryEvents
 * @property Manager $manager
 * @property Type $typeF
 * @property string $type
 */
class Event extends \yii\db\ActiveRecord
{
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
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title', 'content'], 'string'],
            [['manager_id', 'status_id', 'arrangement', 'type_f', 'created_at', 'updated_at'], 'integer'],
            [['document'], 'string', 'max' => 255],
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
            'document' => 'Document',
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
    public function getCategoryEvents()
    {
        return $this->hasMany(CategoryEvent::className(), ['unit_id' => 'id']);
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
}
