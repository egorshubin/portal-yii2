<?php

use app\models\Paper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Paper */

echo Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Газеты', 'url' => ['index']],
        [
            'label' => 'Создание газеты',
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
?>

<h1><span class="blue">Создание газеты</span> </h1>
<?= $this->render('_form_create', [
    'model' => $model,
]) ?>

