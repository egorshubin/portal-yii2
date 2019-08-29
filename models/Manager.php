<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $company
 * @property string $address
 * @property string $email
 * @property string $site
 * @property string $phone
 * @property string $phone_time
 * @property int $type_f
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category[] $categories
 * @property Event[] $events
 * @property Type $typeF
 * @property Paper[] $papers
 * @property Webinar[] $webinars
 */
class Manager extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            yii\behaviors\TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'image'], 'required'],
            [['type_f', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'address'], 'string', 'max' => 255],
            [['company'], 'string', 'max' => 50],
            [['email', 'phone_time'], 'string', 'max' => 60],
            [['site', 'phone'], 'string', 'max' => 20],
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
            'image' => 'Image',
            'company' => 'Company',
            'address' => 'Address',
            'email' => 'Email',
            'site' => 'Site',
            'phone' => 'Phone',
            'phone_time' => 'Phone Time',
            'type_f' => 'Type F',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeF()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_f']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPapers()
    {
        return $this->hasMany(Paper::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebinars()
    {
        return $this->hasMany(Webinar::className(), ['manager_id' => 'id']);
    }
}
