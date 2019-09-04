<?php

use yii\helpers\Html;
use yii\helpers\Url;

$controller_id = Yii::$app->controller->id;
?>

<div class="panel-edit clearfix">

        <?= Html::tag('span','<i class="fa fa-floppy-o left save-icon" aria-hidden="true"></i>
        <span class="subscription">Сохранить</span>', ['class' => 'button-blue button-m left-fa button-margin-right left save save-button', 'title' => 'Сохранить']) ?>

    <?php
    if (!empty($model->id) && $model->status_id == '1' && (($model->type_f == 1) || ($model->type_f == 2) || ($model->type_f == 3))) {
        ?>
        <a class="panel-icon left button-margin-right save-see"
           href="<?= Yii::$app->urlManager->createAbsoluteUrl([$controller_id . '/view', 'id' => $model->id]) ?>"
           target="_blank" title="Посмотреть на сайте">
            <i class="fa fa-eye light-blue" aria-hidden="true"></i>
        </a>
        <?php
    }
    ?>

    <a class="panel-icon left button-margin-right close-link" href="<?= Url::base() ?>/admin/<?= $controller_id ?>/index" title="Закрыть страницу">
        <i class="fa fa-times light-gray" aria-hidden="true"></i>
    </a>
    <? if (!empty($model->id)) {
        echo Html::a('<i class="fa fa-trash-o light-gray" aria-hidden="true"></i>',
            ['delete', 'id' => $model->id],
            [
                'class' => 'panel-icon right delete-trash',
                'title' => "Удалить в корзину",
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]);
    }

    ?>

    <?php
    if ($model->status_id == '1') {
        echo Html::a('<i class="fa fa-toggle-on light-blue" aria-hidden="true"></i>',
            ['unpublish', 'id' => $model->id, 'redirect' => Yii::$app->urlManager->createUrl([ '/admin/' . $controller_id . '/update', 'id' => $model->id])],
            [
            'title' => 'Снять с публикации',
            'class' => 'panel-icon button-margin-right right publishing unpublish',
            'data' => [
                'method' => 'post',
            ],
        ]);
    } else if ($model->status_id == '0') {
        echo Html::a('<i class="fa fa-toggle-off light-gray" aria-hidden="true"></i>', ['publish', 'id' => $model->id, 'redirect' => Yii::$app->urlManager->createUrl([ '/admin/' . $controller_id . '/update', 'id' => $model->id])], [
            'title' => 'Опубликовать',
            'class' => 'panel-icon button-margin-right right publishing publish',
            'data' => [
                'method' => 'post',
            ],
        ]);
    }
    ?>
</div>
