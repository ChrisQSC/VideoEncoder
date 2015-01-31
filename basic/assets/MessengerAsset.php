<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author QinsiCong<wojiaoqsc@gmail.com>
 */
class MessengerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/messenger/messenger.css"
        ,"css/messenger/messenger-theme-flat.css"
    ];
    public $js = [
        "js/messenger/messenger.min.js"
        ,"js/messenger/messenger-theme-flat.js"
        ,"js/messenger/messenger-set.js"
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
