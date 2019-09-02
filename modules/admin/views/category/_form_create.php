<?php

use app\models\Category;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($model); ?>
<div class="panel-container clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?= $form->field($model, 'title', ['options' => ['class' => 'form-group']])->label('Название<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 2]) ?>

<?= $form->field($model, 'category_header', ['options' => ['class' => 'form-group']])->label('Заголовок для клиентов', ['class' => 'form-block-header'])->textarea(['rows' => 2]) ?>

<?= $form->field($model, 'content', ['options' => ['class' => 'form-group']])->label('Описание категории', ['class' => 'form-block-header'])->textarea(['rows' => 6, 'class' => 'content-editor']) ?>
<?= $this->render('@partials/instruct'); ?>

<?= $form->field($model, 'manager_id', ['options' => ['class' => 'form-group']])->label('Отображаемый менеджер<span class="gray">*</span>', ['class' => 'form-block-header'])->dropDownList(ArrayHelper::map($model->managers, 'id', 'title')) ?>

<div class="panel-container panel-container-bottom clearfix">
    <?= $this->render('@partials/edit_panel', ['model' => $model]); ?>
</div>

<?php ActiveForm::end(); ?>

