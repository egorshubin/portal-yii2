<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
    <div class="add-action-wrapper" >
<?php
if($dataProvider->getTotalCount() > 0) {
    ?>
    <span id="reorder-button" class="button-blue button-l right-fa">Порядок <i class="fa fa-exchange fa-rotate-90"></i>
</span>
    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/' . $model::tableName() . '/view', 'id' => $model->id]) ?>" target="_blank" class="button-blue button-l float-right left-fa" id="see-right-button"><i class="fa fa-eye" aria-hidden="true"></i> Посмотреть</a>

<?php
}
else {
?>
    <span class="bigger">В данной категории нет материалов. Добавьте материалы в категорию, на страницах их редактирования.</span>
    <?php
}
?>
</div>
<div id = "type-listing-normal">
<?php
echo \yii\widgets\ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_list_item_in_category',
        'options' => [
            'tag' => 'ul',
            'class' => 'products-list',
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'category-border clearfix'
        ],
        'summary' => '',
        'viewParams' => ['categoryId' => $categoryId]
    ]
);
?>
</div><div id = "type-listing-order" style="display: none" data-category-id = <?= $categoryId ?>>
<?php
echo \yii\widgets\ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_list_item_order',
        'options' => [
            'tag' => 'ul',
            'class' => 'products-list',
            'id' => 'sortable'
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'event-border draggable-list-item ui-state-default ui-sortable-handle'
        ],
        'summary' => ''
    ]
);
?>
    <div class="button-order-confirm-wrapper">
            <span id="reorder-button-confirm" class="button-blue button-l fa-left">
                <i class="fa fa-check" aria-hidden="true"></i>
                Применить
            </span>
    </div>
</div>
