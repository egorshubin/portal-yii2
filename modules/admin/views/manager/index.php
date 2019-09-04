<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджеры';
?>

<h1><span class="blue"><?= Html::encode($this->title) ?></span></h1>

<div class="add-action-wrapper">
    <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', ['create'], ['class' => 'button-blue button-l left-fa']) ?>
</div>

<?= \yii\widgets\ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_list_item',
        'options' => [
            'tag' => 'ul',
            'class' => 'products-list'
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'category-border clearfix'
        ],
        'summary' => ''
    ]
)
?>

