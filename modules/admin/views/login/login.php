<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;?>
<div class="login-wrapper">
    <div class="logo-wrapper">
        <?= Html::img('@web/images/logo2.png', ['alt' => 'Эсколта Софт']) ?>
    </div>
    <div class="form-wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>
        <?= $form->field($model, 'username', ['options' => ['class' => 'form-group']])->label('Логин или e-mail', ['class' => 'login-label'])->textInput(['autofocus' => true, 'class' => 'form-control']) ?>

        <?= $form->field($model, 'password', ['options' => ['class' => 'form-group']])->label('Логин или e-mail', ['class' => 'login-label'])->passwordInput(['class' => 'form-control']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div>{input} {label}</div>\n<div>{error}</div>",
        ]) ?>

        <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-sign-in" aria-hidden="true"></i> Войти', ['class' => 'button-blue button-m left-fa button-border', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
