<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';

?>

<h1><span class="blue"><?= Html::encode($this->title) ?></span></h1>

    <?php Pjax::begin(); ?>
    <?= \yii\widgets\ListView::widget(
            [
                'dataProvider' => $dataProvider,
                'itemView' => '_list',
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

    <?php Pjax::end(); ?>

