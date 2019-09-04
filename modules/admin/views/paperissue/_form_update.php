<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paperissue */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->errorSummary($model); ?>
<div class="panel-container clearfix">
    <?= $this->render('edit_panel', ['model' => $model, 'paper_id' => $paper_id]) ?>
</div>

<?= $form->field($model, 'title', ['options' => ['class' => 'form-group']])->label('Название<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 1]) ?>

<?php if($model->attributes['document'] != '' && $model->attributes['document'] != null) {
    echo $form->field($model, 'document', ['options' => ['class' => 'form-group']])->label('Текущий файл газеты:', ['class' => 'form-block-header'])->textInput(['class' => 'current_invitation_file', 'readonly' => true]);
    echo $form->field($model, 'download', ['options' => ['class' => 'form-group']])->label('Заменить на новый файл:', ['class' => 'form-block-header'])->fileInput(); }
else {
    echo $form->field($model, 'download', ['options' => ['class' => 'form-group']])->label('Загрузить файл газеты:<span class="gray">*</span>', ['class' => 'form-block-header'])->fileInput();
}?>
<div class="little">Форматы pdf, doc, docx, rtf<br>
    Файл размером не больше <?=\app\helpers\CustomHelper::getSizeLimit()?> Мб</div>

<?= $form->field($model, 'month_f', ['options' => ['class' => 'form-group month-select']])->label('Месяц<span class="gray">*</span>', ['class' => 'form-block-header'])->dropDownList(ArrayHelper::map($model->months, 'id', 'title')) ?>

<?= $form->field($model, 'year_f', ['options' => ['class' => 'form-group month-select']])->label('Год<span class="gray">*</span>', ['class' => 'form-block-header'])->textInput() ?>

<?= $form->field($model, 'date', ['options' => ['class' => 'form-group']])->label('Дата обновления', ['class' => 'form-block-header'])->textInput(['class' => 'class-for-updated-at-field', 'disabled' => true])
?>

<div class="panel-container panel-container-bottom clearfix">
    <?= $this->render('edit_panel', ['model' => $model, 'paper_id' => $paper_id]) ?>
</div>

<?php ActiveForm::end(); ?>
