<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

echo Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Статьи', 'url' => ['index']],
        [
            'label' => 'Редактирование статьи',
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
?>

<h1><span class="blue">Редактирование статьи:</span></h1>
<?= $this->render('_form_update', [
    'model' => $model,
]) ?>
