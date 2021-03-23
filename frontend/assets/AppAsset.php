<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/sb-admin-2.min.css',
        'vendor/fontawesome-free/css/all.min.css'
    ];
    public $js = [
        // 'vendor/jquery/jquery.min.js',
        'js/sb-admin-2.js',
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'js/sb-admin-2.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        
    ];
}
