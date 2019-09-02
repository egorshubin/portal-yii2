<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\widgets\Menu;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Панель администратора</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header-wrap">
    <div class="container hidden-lg-up">
        <div class="row">
            <div class="col-12">
                <div class="menu-toggler">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container hidden-menu">
        <div class="row">

            <div class="col-lg-3 menu-wrapper">
                <div class="menu-link">
                    <a href="/admin/index"
                        <?php
                        if (Yii::$app->request->url == Yii::getAlias('/admin/index')) {
                            echo 'class = "active"';
                        }
                        ?>
                    ><i class="fa fa-home" aria-hidden="true"></i>
                        Панель управления</a>
                </div>
            </div>
            <div class="col-lg-7 right-column-wrapper">

            </div>
            <div class="col-lg-2">
                <div class="header-clientLinks logout-wrapper">
                    <a href="">Выйти <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?= Alert::widget() ?>
    <div class="row all-content-wrapper">
        <div class="col-lg-3 menu-wrapper hidden-menu">
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'Категории', 'url' => ['/admin/category/index']],
                    ['label' => 'Статьи', 'url' => ['/admin/event/index']],
                    ['label' => 'Вебинары', 'url' => ['/admin/webinar/index']],
                    ['label' => 'Газеты', 'url' => ['/admin/paper/index']],
                    ['label' => 'Менеджеры', 'url' => ['/admin/manager/index']],
                ],
                'options' => [
                    'class' => 'menu',
                ],
                'itemOptions' => [
                    'class' => 'menu-link'
                ],
                'activeCssClass' => 'active',
                'activateItems' => 'true'
            ]);
            ?>

        </div>
        <div class="col-lg-9 right-column-wrapper">
            <div class="content-wrapper">
                <?= $content ?>
            </div>

        </div>

    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

