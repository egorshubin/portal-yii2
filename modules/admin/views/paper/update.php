<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Paper */
$this->title = $model->title;
echo Breadcrumbs::widget([
    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
    'links' => [
        ['label' => 'Газеты', 'url' => ['index']],
        [
            'label' => Html::encode($this->title),
            'template' => "<li class='breadcrumb-item'>{link}</li>", // template for this link only
        ],

    ],
    'homeLink' => false
]);
?>

<h1><span class="blue">Газета</span><br> <?=Html::encode($this->title)?></h1>
<?=
$this->render('@partials/list_tabs_wrapper');
?>
<div id="category-description-wrapper" class="category-description-wrapper">
<?= $this->render('_form_update', [
    'model' => $model,
]) ?>
</div>
<div id="category-list-wrapper" class="opened-body">
    <?= $this->render('issues_list', [
        'paper_id' => $model->id,
        'years' => $years,
        'paperissues' => $paperissues
    ]) ?>
</div>
