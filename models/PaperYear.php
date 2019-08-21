<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paper_year".
 *
 * @property int $year_f
 *
 * @property Paperissue[] $paperissues
 */
class PaperYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paper_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_f'], 'required'],
            [['year_f'], 'integer'],
            [['year_f'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'year_f' => 'Year F',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaperissues()
    {
        return $this->hasMany(Paperissue::className(), ['year_f' => 'year_f']);
    }
}
