<?php
use yii\helpers\Html;

$edit = Html::a('<i class="edit-icon fa fa-pencil" aria-hidden="true"></i>' . $attributes['title'], ['/admin/' . $attributes['type'] . '/update', 'id' => $model->id], ['class' => 'list-title-block']);

if (($model->id != '1' && $attributes['type_f'] != '5') || ($model->id != '1' && $attributes['type_f'] == '5')) {
    $delete = Html::a('<i class="delete-icon fa fa-trash gray archive"></i>', ['delete', 'id' => $model->id], [
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить?',
            'method' => 'post',
        ],
    ]);
}


if ($attributes['status_id'] == 1) {
    $publish = Html::a('<i class="status-icon fa unpublish fa-toggle-on blue" aria-hidden="true"></i>', ['unpublish', 'id' => $model->id, 'redirect' => 'index'], [
        'title' => 'Снять с публикации',
        'data' => [
            'method' => 'post',
        ],
    ]);
} else {
    $publish = Html::a('<i class="status-icon fa publish fa-toggle-off red" aria-hidden="true"></i>', ['publish', 'id' => $model->id, 'redirect' => 'index'], [
        'title' => 'Опубликовать',
        'data' => [
            'method' => 'post',
        ],
    ]);
}


$lookout = Html::tag('div', '', ['class' => 'clearfix']) .
    Html::tag('div',
        Html::a(
            Html::tag('i', '', ['class' => 'fa fa-eye']),
            ['/' . $attributes['type'] . '/view', 'id' => $model->id],
            ['class' => 'href-copy-a', 'title' => 'Посмотреть на сайте', 'target' => '_blank']
        ) .
        Html::input('text', '', Yii::$app->urlManager->createAbsoluteUrl(['/' . $attributes['type'] . '/view', 'id' => $model->id]), ['class' => 'href-copy-input', 'readonly' => 'readonly']),
        ['class' => 'href-copy']);


echo
    $edit .
    '<span class="list-buttons-block">' .
     $delete;
if ($publishAllowed) {
    echo $publish;
}
    echo '</span>';
if ($hashref) {
    echo $lookout;
}

