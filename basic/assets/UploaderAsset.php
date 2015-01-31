<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qinsicong <wojiaoqsc@gmail.com>
 */
class UploaderAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/uploader/blueimp-gallery.min.css"
        ,"css/uploader/jquery.fileupload.css"
        ,"css/uploader/style.css"
        ,"css/uploader/jquery.fileupload-ui.css"
    ];
    public $js = [
        "js/uploader/jquery.ui.widget.js"
        ,"js/uploader/tmpl.min.js"
        ,"js/uploader/load-image.all.min.js"
        ,"js/uploader/canvas-to-blob.min.js"
        ,"js/uploader/jquery.blueimp-gallery.min.js"
        ,"js/uploader/jquery.iframe-transport.js"
        ,"js/uploader/jquery.fileupload.js"
        ,"js/uploader/jquery.fileupload-process.js"
        ,"js/uploader/jquery.fileupload-image.js"
        ,"js/uploader/jquery.fileupload-audio.js"
        ,"js/uploader/jquery.fileupload-video.js"
        ,"js/uploader/jquery.fileupload-validate.js"
        ,"js/uploader/jquery.fileupload-ui.js"
        ,"js/uploader/uploader.js"
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
