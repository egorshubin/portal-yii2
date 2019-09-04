<?php

use app\models\Category;
use yii\helpers\Html;
use yii\web\View;
use app\widgets\ListItemAdmin\ListItemAdmin;

/* @var $this yii\web\View */

$this->title = $model->title;

\yii\web\YiiAsset::register($this);
?>

<?= ListItemAdmin::widget([
    'model' => $model,
    'attributes' => [
        'title',
        'status_id',
        'type',
        'type_f'
    ],
    'template' => '{value}',
    'hashref' => false,
    'publishAllowed' => false
]) ?>

