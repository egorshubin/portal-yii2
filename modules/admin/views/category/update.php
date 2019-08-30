<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;

?>

<h1><?= '<span class="blue">Редактирование категории:</span><br>' . Html::encode($this->title) ?></h1>
<?=
    $this->render('list_tabs_wrapper');
?>
<div id="category-description-wrapper" class="category-description-wrapper">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<div id="category-list-wrapper">
    <?= $this->render('contents_list_sorted', [
        'dataProvider' => $dataProvider
    ]) ?>
</div>

