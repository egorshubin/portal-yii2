<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Paperissue */

$this->title = 'Create PaperissueSearch';
$this->params['breadcrumbs'][] = ['label' => 'Paperissues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paperissue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
