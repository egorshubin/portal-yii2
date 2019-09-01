<?php

use app\models\Category;
use yii\helpers\Html;
use yii\web\View;
use app\widgets\ListItemAdmin\ListItemAdminCategory;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->title;

\yii\web\YiiAsset::register($this);
?>

    <?= ListItemAdminCategory::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'status_id',
            'type'
        ],
        'template' => '{value}',
        'hashref' => true,
    ]) ?>
