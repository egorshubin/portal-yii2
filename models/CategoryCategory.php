<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_category".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $parent_id
 * @property int $depth
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $parent
 */
class CategoryCategory extends \yii\db\ActiveRecord
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
        return 'category_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'parent_id', 'depth', 'created_at', 'updated_at'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_id' => 'Unit ID',
            'parent_id' => 'Parent ID',
            'depth' => 'Depth',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }
}
