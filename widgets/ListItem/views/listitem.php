<?php
use yii\helpers\Html;
if ($attributes['status_id'] == 1) {
    ?>
    <li>
        <?= Html::a($attributes['title'], ['category/view', 'id' => $model->id]) ?>
    </li>
    <?php
}
