<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Paperissue */

echo Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Газеты', 'url' => ['paper/index']],
        ['label' => $paper_title ? $paper_title : 'Текущая газета', 'url' => $paper_id ?  ['paper/update', 'id' => $paper_id] : '#'],
        [
            'label' => $model->title,
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
?>
<h1><span class="blue">Редактирование выпуска</span> </h1>
<?= $this->render('_form_update', [
    'model' => $model,
    'paper_id' => $paper_id
]) ?>
