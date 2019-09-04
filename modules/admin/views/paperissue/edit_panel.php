<?php

use yii\helpers\Html;
use yii\helpers\Url;

$controller_id = Yii::$app->controller->id;
?>

<div class="panel-edit clearfix">

        <?= Html::tag('span','<i class="fa fa-floppy-o left save-icon" aria-hidden="true"></i>
        <span class="subscription">Сохранить</span>', ['class' => 'button-blue button-m left-fa button-margin-right left save save-button', 'title' => 'Сохранить']) ?>

    <?php
    if (!empty($model->id)) {
        ?>
        <a class="panel-icon left button-margin-right save-see"
           href="<?= Yii::$app->urlManager->createAbsoluteUrl([$controller_id . '/view', 'id' => $model->id]) ?>"
           target="_blank" title="Посмотреть на сайте">
            <i class="fa fa-eye light-blue" aria-hidden="true"></i>
        </a>
        <?php
    }
    ?>
    <?= Html::a('<i class="fa fa-times light-gray" aria-hidden="true"></i>',
        ['/admin/paper/update', 'id' => $paper_id],
        [
            'class' => 'panel-icon left button-margin-right close-link',
            'title' => "Закрыть страницу",
        ])?>

    <?php //if not the first manager
     if (!empty($model->id)) {
        echo Html::a('<i class="fa fa-trash-o light-gray" aria-hidden="true"></i>',
             ['delete', 'id' => $model->id, 'paper_id' => $paper_id],
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
</div>
