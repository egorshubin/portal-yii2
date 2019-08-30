<?php
namespace app\assets;
use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/admin.css',
    ];
    public $js = [
        'tinymce/tinymce.min.js',
        'js/admin.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}