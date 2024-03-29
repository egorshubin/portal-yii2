<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paper".
 *
 * @property int $id
 * @property string $title
 * @property int $manager_id
 * @property int $status_id
 * @property int $arrangement
 * @property int $type_f
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryPaper[] $categoryPapers
 * @property Manager $manager
 * @property Type $typeF
 * @property string $type
 * @property PaperissueTie[] $paperissueTies
 * @property array $categories
 * @property array $checkedIds
 */
class Paper extends \yii\db\ActiveRecord
{
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
        return 'paper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['manager_id', 'status_id', 'arrangement', 'type_f', 'created_at', 'updated_at'], 'integer'],
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
    public function getCategoryPapers()
    {
        return $this->hasMany(CategoryPaper::className(), ['unit_id' => 'id']);
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

    /**
     * @return mixed
     */
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

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategories() {
        return Category::find()
            ->indexBy('id')
            ->all();
    }

    /**
     * @return array
     */
    public function getCheckedIds() {
        $rawArray = $this->getCategoryPapers()->all();
        $checkedIds = [];
        foreach ($rawArray as $row) {
            $checkedIds[] = $row->attributes['parent_id'];
        }
        return $checkedIds;
    }

    /**
     * @param $checkedIds
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function saveCheckedIds($checkedIds) {
        if ($checkedIds) {
            $this->deleteFromCategoryPaper();
            foreach ($checkedIds as $catid) {
                $m= new CategoryPaper();
                $m->unit_id = $this->id;
                $m->parent_id = $catid;
                $m->save();
            }

            return true;
        }
        return false;
    }

    public function deleteFromCategoryPaper() {
        $model = CategoryPaper::find();
        $oldArray = $model
            ->where('unit_id = ' . $this->id)
            ->all();
        foreach ($oldArray as $row) {
            $row->delete();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaperissue()
    {
        return $this->hasMany(Paperissue::className(), ['paper_id' => 'id']);
    }
}
