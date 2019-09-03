<?php

use app\models\Webinar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Webinar */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->errorSummary($model); ?>
<div class="panel-container clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?= $form->field($model, 'title', ['options' => ['class' => 'form-group']])->label('Название<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 2]) ?>

<?= $form->field($model, 'download', ['options' => ['class' => 'form-group']])->label('Загрузить файл вебинара:<span class="gray">*</span>', ['class' => 'form-block-header'])->fileInput();
?>
<div class="little">Формат mp4<br>
    Файл размером не больше <?=\app\helpers\CustomHelper::getSizeLimit()?> Мб</div>

<?= $form->field($model, 'content', ['options' => ['class' => 'form-group']])->label('Дополнительный текст под видео', ['class' => 'form-block-header'])->textarea(['rows' => 6, 'class' => 'content-editor']) ?>
<?= $this->render('@partials/instruct'); ?>

<?= $form->field($model, 'checkedIds', ['options' => ['class' => 'form-group checklist']])->label('Родительские категории', ['class' => 'form-block-header'])->checkboxList(ArrayHelper::map($model->categories, 'id', 'title')) ?>

<?= $form->field($model, 'manager_id', ['options' => ['class' => 'form-group']])->label('Отображаемый менеджер<span class="gray">*</span>', ['class' => 'form-block-header'])->dropDownList(ArrayHelper::map($model->managers, 'id', 'title')) ?>

<div class="panel-container panel-container-bottom clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?php ActiveForm::end(); ?>

