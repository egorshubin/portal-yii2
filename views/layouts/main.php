<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 logos">
                <div class="top-row">
                    <span class="tm-texpert header-siteLink"></span>
                    <span class="tm-kodeks header-siteLink"></span>
                </div>
                <div class="middle-row">
                    <span>
                        <?= Html::img('@web/images/logo_intranet.png', ['alt' => 'Интранет']) ?></span>
                </div>
                <div class="bottom-row">
                    <div class="header-version">Кодекс-сервер 6.4.1.127 (x64) версия для Windows</div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="wrap">
    <div class="container">
        <?= Alert::widget() ?>
        <div class="row">
            <div class="col-lg-9 push-lg-3 right-content-wrapper">
                <?php
                if (!is_null($_SERVER['HTTP_REFERER'])) {
                    ?>
                    <div class="back-button-wrapper add-action-wrapper">
                        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="button-empty back-button"><span
                                    class="icon-left-big"
                                    aria-hidden="true"></span>Назад</a>
                    </div>
                    <?php
                } ?>
                <?= $content ?>
            </div>
            <div class="col-lg-3 pull-lg-9">
                <div class="contacts">
                    <p>Вас обслуживает:<br>
                        <!--                        --><? //=$data['m_company']?>
                    </p>
                    <div class="service-photo-row clearfix">
                        <!--                        --><?php
                        //                        if (!is_null($data['m_image']) && $data['m_image'] != '') {
                        //                            ?>
                        <!--                            <div class="manager-photo">-->
                        <!--                                <img src="/images/--><? //=$data['m_image'] ?><!--" alt="-->
                        <? //= $data['m_name'] ?><!--">-->
                        <!--                            </div>-->
                        <!--                            --><?php
                        //                        }
                        //                        ?>
                        <!--                        <div class="manager-name">-->
                        <!--                            --><? //=$data['m_name']?>
                        <!--                        </div>-->
                    </div>
                    <!--                    <p>--><? //=$data['m_address']?><!--<br>-->
                    <!--                        <a href="mailto:--><? //=$data['m_email']?><!--">-->
                    <? //=$data['m_email']?><!--</a><br>-->
                    <!--                        <a href="http://--><? //=$data['m_site']?><!--">-->
                    <? //=$data['m_site']?><!--</a></p>-->
                    <!--                    <div>-->
                    <!--                        <span class="service-phone">-->
                    <? //=$data['m_phone']?><!--</span><br>-->
                    <!--                        <span class="phone-time">--><? //=$data['m_phone_time']?><!--</span>-->
                    <!--                    </div>-->

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
