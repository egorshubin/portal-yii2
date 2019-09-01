<?php
namespace app\widgets\ListItemAdminCategory;


use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

class ListItemAdminCategory extends DetailView
{
    public $hashref;
    public $categoryId;
    public function run()
    {
        $rows = [];
        $i = 0;
        foreach ($this->attributes as $attribute) {
            $rows[$attribute['attribute']] = $this->renderAttribute($attribute, $i++);
        }
        return $this->render('list_item_admin_category', ['model' => $this->model, 'attributes' => $rows, 'hashref' => $this->hashref, 'categoryId' => $this->categoryId]);
    }
}