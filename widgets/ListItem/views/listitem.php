<?php

use yii\helpers\Html;

$edit = Html::a('<i class="edit-icon fa fa-pencil" aria-hidden="true"></i>' . $attributes['title'], ['update', 'id' => $model->id], ['class' => 'list-title-block']);
$delete = Html::a('<i class="delete-icon fa fa-trash gray archive"></i>', ['delete', 'id' => $model->id], [
    'data' => [
        'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
        'method' => 'post',
    ],
]);

if ($hashref) {
    $lookout = '';
}
else {
    $lookout = '';
}

echo
    $edit .
    '<span class="list-buttons-block">' .
    $delete .
//    $status .
    '</span>'
//    $lookout .
    ;
