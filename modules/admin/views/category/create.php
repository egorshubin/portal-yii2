<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
echo Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Категории', 'url' => ['index']],
        [
            'label' => 'Создание категории',
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
$this->title = 'Создать категорию';

?>
<div class="category-create">

    <h1><span class="blue"><?= Html::encode($this->title) ?></span></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
    ]) ?>

</div>
