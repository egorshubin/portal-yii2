<?php
namespace app\helpers;


class CustomHelper
{
    public static function getSizeLimit() {
        return preg_replace("/[^0-9]/", '', ini_get('upload_max_filesize'));
    }
    public static function getSizeLimitBytes() {
        return self::getSizeLimit() * 1024 * 1024;
    }
}