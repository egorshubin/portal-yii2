<?php
use yii\helpers\Html;

$edit = Html::a('<i class="edit-icon fa fa-pencil" aria-hidden="true"></i>' . $attributes['title'], ['/admin/' . $attributes['type'] . '/update', 'id' => $model['id']], ['class' => 'list-title-block']);

$delete = Html::a('<i class="delete-icon fa fa-trash gray archive"></i>', ['delete', 'id' => $model['id']], [
    'data' => [
        'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
        'method' => 'post',
    ],
]);

    $unbindFromCategory = Html::a('<i class="fa fa-chain-broken gray offcategory-icon" aria-hidden="true"></i>', ['offcategory', 'id' => $model['id'], 'redirect' => '/admin/category/update', 'categoryId' => $categoryId, 'tableName' => $attributes['type']], [
        'title' => 'Открепить от категории',
        'data' => [
            'method' => 'post',
        ],
    ]);

if ($attributes['status_id'] == 1) {
    $publish = Html::a('<i class="status-icon fa unpublish fa-toggle-on blue" aria-hidden="true"></i>', ['unpublish', 'id' => $model['id'], 'redirect' => 'index'], [
        'title' => 'Снять с публикации',
        'data' => [
            'method' => 'post',
        ],
    ]);
} else {
    $publish = Html::a('<i class="status-icon fa publish fa-toggle-off red" aria-hidden="true"></i>', ['publish', 'id' => $model['id'], 'redirect' => 'index'], [
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
            ['/' . $attributes['type'] . '/view', 'id' => $model['id']],
            ['class' => 'href-copy-a', 'title' => 'Посмотреть на сайте', 'target' => '_blank']
        ) .
        Html::input('text', '', Yii::$app->urlManager->createAbsoluteUrl(['/' . $attributes['type'] . '/view', 'id' => $model['id']]), ['class' => 'href-copy-input', 'readonly' => 'readonly']),
        ['class' => 'href-copy']);


echo
    $edit .
    '<span class="list-buttons-block">';
if (($categoryId) && ($categoryId != null) && ($categoryId != '')) {
    echo $unbindFromCategory;
}
echo
    $publish . '</span>';
if ($hashref) {
    echo $lookout;
}

