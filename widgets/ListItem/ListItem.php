<?php
namespace app\widgets\ListItem;


use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

class ListItem extends DetailView
{
    public $hashref;
    public function run()
    {
        $rows = [];
        $i = 0;
        foreach ($this->attributes as $attribute) {
            $rows[$attribute['attribute']] = $this->renderAttribute($attribute, $i++);
        }
        return $this->render('listitem', ['model' => $this->model, 'attributes' => $rows, 'hashref' => $this->hashref]);
    }
}