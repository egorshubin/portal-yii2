<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->title;

?>

<h1><?= '<span class="blue">Редактирование категории:</span><br>' . Html::encode($this->title) ?></h1>
<?=
    $this->render('@partials/list_tabs_wrapper');
?>
<div id="category-description-wrapper" class="category-description-wrapper">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<div id="category-list-wrapper">

</div>

