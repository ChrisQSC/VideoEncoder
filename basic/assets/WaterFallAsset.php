<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qinsicong <wojiaoqsc@gmail.com>
 */
class WaterFallAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        "css/waterfall/waterfall.css",
    ];
    public $js = [
        "js/waterfall/imagesloaded.pkgd.min.js",
         "js/waterfall/masonry.pkgd.min.js",
         "js/waterfall/waterfall.init.js"
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
