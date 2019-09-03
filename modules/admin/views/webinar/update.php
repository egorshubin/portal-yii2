<?php

use app\models\Webinar;
use yii\helpers\Html;

/* @var $this yii\web\View */

use yii\web\View;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Webinar */

echo Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Вебинары', 'url' => ['index']],
        [
            'label' => 'Редактирование вебинара',
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
?>

<h1><span class="blue">Редактирование вебинара:</span></h1>
<?= $this->render('_form_update', [
    'model' => $model,
]) ?>
