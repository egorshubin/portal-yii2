<?php

use yii\data\ActiveDataProvider;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo \yii\widgets\ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'options' => [
            'tag' => 'ul',
            'class' => 'products-list',
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'category-border clearfix'
        ],
        'summary' => ''
    ]
);
