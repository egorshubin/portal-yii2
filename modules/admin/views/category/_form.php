<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <div class="panel-container clearfix">
        <?= $this->render('@app/modules/admin/views/partials/edit_panel', ['model' => $model]); ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title', ['options' => ['class' => 'form-group']])->label('Название<span class="gray">*</span>', ['class' => 'form-block-header'])->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'category_header', ['options' => ['class' => 'form-group']])->label('Заголовок для клиентов', ['class' => 'form-block-header'])->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'content', ['options' => ['class' => 'form-group']])->label('Описание категории', ['class' => 'form-block-header'])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'manager_id', ['options' => ['class' => 'form-group']])->label('Отображаемый менеджер<span class="gray">*</span>', ['class' => 'form-block-header'])->dropDownList(ArrayHelper::map($model->managers, 'id', 'title')) ?>

    <?= $form->field($model, 'date', ['options' => ['class' => 'form-group']])->label('Дата обновления', ['class' => 'form-block-header'])->textInput(['class' => 'class-for-updated-at-field', 'disabled' => true]) ?>

    <div class="panel-container panel-container-bottom clearfix">
        <?= $this->render('@app/modules/admin/views/partials/edit_panel', ['model' => $model]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
