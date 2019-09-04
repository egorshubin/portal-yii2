<?php

use yii\helpers\Html;

?>
<h2 class="form-block-header mb-30">Список выпусков:</h2>
<div class="add-action-wrapper">
    <?= Html::a('<i
                class="fa fa-plus" aria-hidden="true"></i>Добавить
        новый выпуск', ['paperissue/create', 'paper_id' => $paper_id], ['title' => 'Создать новую', 'class' => 'button-blue button-l left-fa'])?>

</div>

<div class="add-action-wrapper">
    <?php
    foreach ($years as $year) {
        echo '<span class="button-year button-empty button-m button-margin-right' . ($years[0]['year_f'] == $year['year_f'] ? ' button-empty-active' : '') . '" data-year="' . $year['year_f'] . '" data-id="' . $paper_id . '">' . $year['year_f'] . '</span>';
    }
    ?>
</div>
<div class="papers-list-wrapper">
    <div id="delete-all-wrapper"></div>
    <div id="loader" class="add-action-wrapper" style="display: none;">
        <?= Html::img('@web/images/ajax-loader.gif', ['alt' => 'Loading, Loading!']) ?>
    </div>
    <ul class="papers-list" id="papers-list">
        <?php
        foreach ($paperissues as $paperissue) {
            echo '<li class="papers-list-item">';
            echo Html::a('<i class="edit-icon fa fa-pencil" aria-hidden="true"></i>' . $paperissue['title'], ['/admin/paperissue/update', 'id' => $paperissue['id'], 'paper_id' => $paper_id], ['title' => 'Редактировать']);
            echo Html::a('<i class="delete-paper-icon fa fa-trash gray delete-forever"></i>', ['/admin/paperissue/delete', 'id' => $paperissue['id'], 'paper_id' => $paper_id], ['title' => 'Удалить']);
echo '</li>';
        }
        ?>
    </ul>
</div>
