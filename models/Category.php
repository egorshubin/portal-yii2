<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $category_header
 * @property string $content
 * @property int $manager_id
 * @property int $status_id
 * @property int $arrangement
 * @property int $type_f
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Manager $manager
 * @property array $managers
 * @property array $categories
 * @property string $date
 * @property string $type
 * @property Type $typeF
 * @property CategoryCategory[] $categoryCategories
 * @property CategoryEvent[] $categoryEvents
 * @property CategoryPaper[] $categoryPapers
 * @property CategoryWebinar[] $categoryWebinars
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'manager_id'], 'required'],
            [['title', 'category_header', 'content'], 'string'],
            [['manager_id', 'status_id', 'arrangement', 'type_f'], 'integer'],
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
            'title' => 'Название',
            'category_header' => 'Заголовок для клиентов',
            'content' => 'Описание',
            'manager_id' => 'Manager ID',
            'status_id' => 'Status ID',
            'arrangement' => 'Arrangement',
            'type_f' => 'Type F',
            'created_at' => 'Created At',
            'updated_at' => 'Последнее обновление',
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['id' => 'manager_id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getManagers() {
        return Manager::find()
            ->indexBy('id')
            ->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategories() {
        return Category::find()
            ->indexBy('id')
            ->all();
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCategories()
    {
        return $this->hasMany(CategoryCategory::className(), ['parent_id' => 'id']);
    }

    public function getCategoryCategory() {
        return $this->hasMany(CategoryCategory::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryEvents()
    {
        return $this->hasMany(CategoryEvent::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPapers()
    {
        return $this->hasMany(CategoryPaper::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryWebinars()
    {
        return $this->hasMany(CategoryWebinar::className(), ['parent_id' => 'id']);
    }
}
