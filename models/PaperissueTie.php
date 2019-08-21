<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paperissue_tie".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $paper_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Paperissue $unit
 * @property Paper $paper
 */
class PaperissueTie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paperissue_tie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'paper_id'], 'required'],
            [['unit_id', 'paper_id', 'created_at', 'updated_at'], 'integer'],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paperissue::className(), 'targetAttribute' => ['unit_id' => 'id']],
            [['paper_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paper::className(), 'targetAttribute' => ['paper_id' => 'id']],
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
            'paper_id' => 'Paper ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Paperissue::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(Paper::className(), ['id' => 'paper_id']);
    }
}
