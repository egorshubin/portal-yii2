<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = $model->title;

echo Breadcrumbs::widget([
        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Категории', 'url' => ['index']],
        [
            'label' => 'Редактирование категории',
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
?>

<h1><?= '<span class="blue">Редактирование категории:</span><br>' . Html::encode($this->title) ?></h1>
<?=
    $this->render('list_tabs_wrapper');
?>
<div id="category-description-wrapper" class="category-description-wrapper">
    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>
</div>
<div id="category-list-wrapper" class="opened-body">
    <?= $this->render('contents_list_sorted', [
         'model' => $model,
        'dataProvider' => $dataProvider,
        'categoryId' => $model->id,
    ]) ?>
</div>

