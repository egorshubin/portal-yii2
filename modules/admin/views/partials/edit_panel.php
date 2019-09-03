<?php

use yii\helpers\Html;
use yii\helpers\Url;

$controller_id = Yii::$app->controller->id;
?>

<div class="panel-edit clearfix">
    <div class="panel-point left save">
        <?= Html::submitButton('<i class="fa fa-floppy-o light-blue save-icon" aria-hidden="true"></i><div class="clearfix"></div>
        <span class="subscription">Сохранить</span>', ['class' => 'button-save-wrap']) ?>
    </div>
    <?php
    if (!empty($model->id) && $model->status_id == '1' && (($model->type_f == 1) || ($model->type_f == 2) || ($model->type_f == 3))) {
        ?>
        <a class="panel-point left save-see"
           href="<?= Yii::$app->urlManager->createAbsoluteUrl([$controller_id . '/view', 'id' => $model->id]) ?>"
           target="_blank">
            <i class="fa fa-eye light-blue" aria-hidden="true"></i>
            <div class="clearfix"></div>
            <span class="subscription">Посмотреть</span>
        </a>
        <?php
    }
    ?>

    <a class="panel-point close-link left" href="<?= Url::base() ?>/admin/<?= $controller_id ?>/index">
        <i class="fa fa-times light-gray" aria-hidden="true"></i>
        <div class="clearfix"></div>
        <span class="subscription">Закрыть</span>
    </a>
    <?=
    Html::a('<i class="fa fa-trash-o light-gray" aria-hidden="true"></i>
        <div class="clearfix"></div>
        <span class="subscription">Удалить</span>',
        ['delete', 'id' => $model->id],
        [
            'class' => 'panel-point right archive-panel',
            'title' => "Удалить в корзину",
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]);
    ?>

    <?php
    if ($model->status_id == '1') {
        echo Html::a('<i class="fa fa-toggle-on light-blue" aria-hidden="true"></i>
<div class="clearfix"></div>
        <span class="subscription">Опубликовано</span>',
            ['unpublish', 'id' => $model->id, 'redirect' => Yii::$app->urlManager->createUrl([ '/admin/' . $controller_id . '/update', 'id' => $model->id])],
            [
            'title' => 'Снять с публикации',
            'class' => 'panel-point right publishing unpublish',
            'data' => [
                'method' => 'post',
            ],
        ]);
    } else if ($model->status_id == '0') {
        echo Html::a('<i class="fa fa-toggle-off light-gray" aria-hidden="true"></i>
            <div class="clearfix"></div>
            <span class="subscription">Не опубликовано</span>', ['publish', 'id' => $model->id, 'redirect' => Yii::$app->urlManager->createUrl([ '/admin/' . $controller_id . '/update', 'id' => $model->id])], [
            'title' => 'Опубликовать',
            'class' => 'panel-point right publishing publish',
            'data' => [
                'method' => 'post',
            ],
        ]);
    }
    ?>
</div>
