<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qinsicong <wojiaoqsc@gmail.com>
 */
class VideoJSAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        "compenents/videojs/video-js.css",
    ];
    public $js = [
        "compenents/videojs/video.novtt.dev.js"
    ];
}
