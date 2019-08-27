<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ManagerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manager-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'site') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'phone_time') ?>

    <?php // echo $form->field($model, 'type_f') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
