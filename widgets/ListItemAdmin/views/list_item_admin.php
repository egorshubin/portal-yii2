<?php

use yii\helpers\Html;

$edit = Html::a('<i class="edit-icon fa fa-pencil" aria-hidden="true"></i>' . $attributes['title'], ['update', 'id' => $model->id], ['class' => 'list-title-block']);

$delete = Html::a('<i class="delete-icon fa fa-trash gray archive"></i>', ['delete', 'id' => $model->id], [
    'data' => [
        'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
        'method' => 'post',
    ],
]);

$publish = ;



if ($hashref) {
    $lookout = Html::tag('div', '', ['class' => 'clearfix']) .
        Html::tag('div',
            Html::a(
                Html::tag('i', '', ['class' => 'fa fa-eye']),
                ['/category/view', 'id' => $model->id],
                ['class' => 'href-copy-a', 'title' => 'Посмотреть на сайте', 'target' => '_blank']
            ) .
            Html::input('text', '', Yii::$app->urlManager->createAbsoluteUrl(['category/view', 'id' => $model->id]), ['class' => 'href-copy-input', 'readonly' => 'readonly']),
            ['class' => 'href-copy']);
}
else {
    $lookout = '';
}

echo
    $edit .
    '<span class="list-buttons-block">' .
    $delete .
//    $publish .
    '</span>' .
    $lookout
    ;
