<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';

?>

<h1><span class="blue"><?= Html::encode($this->title) ?></span></h1>

    <div class="add-action-wrapper">
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', ['create'], ['class' => 'button-blue button-l left-fa']) ?>
    </div>

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

