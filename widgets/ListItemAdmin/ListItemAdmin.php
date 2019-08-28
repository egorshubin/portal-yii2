<?php
namespace app\widgets\ListItemAdmin;


use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

class ListItemAdmin extends DetailView
{
    public $hashref;
    public function run()
    {
        $rows = [];
        $i = 0;
        foreach ($this->attributes as $attribute) {
            $rows[$attribute['attribute']] = $this->renderAttribute($attribute, $i++);
        }
        return $this->render('list_item_admin', ['model' => $this->model, 'attributes' => $rows, 'hashref' => $this->hashref]);
    }
}