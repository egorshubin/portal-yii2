<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->errorSummary($model); ?>
<div class="panel-container clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?= $form->field($model, 'title', ['options' => ['class' => 'form-group']])->label('Название<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 2]) ?>

<?= $form->field($model, 'content', ['options' => ['class' => 'form-group']])->label('Текст<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 20, 'class' => 'content-editor']) ?>
<?= $this->render('@partials/instruct'); ?>

<?php if($model->attributes['document'] != '' && $model->attributes['document'] != null) {
echo $form->field($model, 'document', ['options' => ['class' => 'form-group']])->label('Текущий файл приглашения:', ['class' => 'form-block-header'])->textInput(['class' => 'current_invitation_file', 'readonly' => true]);
echo $form->field($model, 'download', ['options' => ['class' => 'form-group']])->label('Заменить на новый файл:', ['class' => 'form-block-header'])->fileInput(); }
else {
    echo $form->field($model, 'download', ['options' => ['class' => 'form-group']])->label('Загрузить файл приглашения:', ['class' => 'form-block-header'])->fileInput();
    }?>
<div class="little">Форматы doc, docx, rtf, pdf, odt, jpg, png<br>
    Файл размером не больше <?=\app\helpers\CustomHelper::getSizeLimit()?> Мб</div>

<?= $form->field($model, 'checkedIds', ['options' => ['class' => 'form-group checklist']])->label('Родительские категории', ['class' => 'form-block-header'])->checkboxList(ArrayHelper::map($model->categories, 'id', 'title')) ?>

<?= $form->field($model, 'manager_id', ['options' => ['class' => 'form-group']])->label('Отображаемый менеджер<span class="gray">*</span>', ['class' => 'form-block-header'])->dropDownList(ArrayHelper::map($model->managers, 'id', 'title')) ?>

<?= $form->field($model, 'date', ['options' => ['class' => 'form-group']])->label('Дата обновления', ['class' => 'form-block-header'])->textInput(['class' => 'class-for-updated-at-field', 'disabled' => true])
?>

<div class="panel-container panel-container-bottom clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?php ActiveForm::end(); ?>