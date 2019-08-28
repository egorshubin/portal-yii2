<?php

use app\models\Category;
use yii\helpers\Html;
use yii\web\View;
use app\widgets\ListItem\ListItem;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>

    <?= ListItem::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'status_id'
        ],
        'template' => '{value}',
        'hashref' => true
    ]) ?>
