<?php

use yii\helpers\Html;
use yii\web\View;
use app\widgets\ListItemAdminCategory\ListItemAdminCategory;

/* @var $this yii\web\View */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>

<?= ListItemAdminCategory::widget([
    'model' => $model,
    'attributes' => [
        'title',
        'status_id',
        'type'
    ],
    'template' => '{value}',
    'hashref' => true,
    'categoryId' => $categoryId
]) ?>
