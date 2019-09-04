<?php

use app\models\Manager;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Manager */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->errorSummary($model); ?>
<div class="panel-container clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?= $form->field($model, 'title', ['options' => ['class' => 'form-group']])->label('Имя<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'download', ['options' => ['class' => 'form-group']])->label('Загрузить фотографию:<span class="gray">*</span>', ['class' => 'form-block-header'])->fileInput()?>
<div class="little">Формат jpg, png<br>
    Рекомендуемые размеры изображения 50 X 75px, вертикальная ориентация<br>
    Файл размером не больше <?=\app\helpers\CustomHelper::getSizeLimit()?> Мб</div>

<?= $form->field($model, 'company', ['options' => ['class' => 'form-group']])->label('Компания<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'address', ['options' => ['class' => 'form-group']])->label('Адрес<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'email', ['options' => ['class' => 'form-group']])->label('Email<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'site', ['options' => ['class' => 'form-group']])->label('Сайт<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'phone', ['options' => ['class' => 'form-group']])->label('Телефон<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'phone_time', ['options' => ['class' => 'form-group']])->label('Время работы<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<div class="panel-container panel-container-bottom clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?php ActiveForm::end(); ?>

