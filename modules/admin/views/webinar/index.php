<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\WebinarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Webinars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="webinar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create WebinarSearch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            'content:ntext',
            'video',
            'manager_id',
            //'status_id',
            //'arrangement',
            //'type_f',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
