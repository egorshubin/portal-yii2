<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\WebinarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вебинары';
?>

<h1><span class="blue"><?= Html::encode($this->title) ?></span></h1>

<div class="add-action-wrapper">
    <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', ['create'], ['class' => 'button-blue button-l left-fa']) ?>
</div>

<?= \yii\widgets\ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => '@partials/_list_item',
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

