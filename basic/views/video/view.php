<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\VideoJSAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

VideoJSAsset::register($this);

$this->title = $model->filename;
$this->params['breadcrumbs'][] = ['label' => '视频', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">
<!--
    <?php
    $file_dir = pathinfo($model->path,PATHINFO_DIRNAME);
    $mp4_path_low = '/files/low/'.$model->md5.'.mp4';
    $mp4_path_mid = '/files/mid/'.$model->md5.'.mp4';
    $mp4_path_high = '/files/high/'.$model->md5.'.mp4';
    ?>
    <div class = 'col-lg-12'>
    <video src='<?php echo $mp4_path_low?>' width="100%" controls="controls">
    Your browser does not support the video tag.
    </video>
    <div class="btn-group">
        <?= Html::a(Html::Button('超清', ['class' => 'btn btn-success', $model->attributes['1080p'] ?:'disabled'=>"disabled"]),$mp4_path_high) ?>
        <?= Html::a(Html::Button('高清', ['class' => 'btn btn-success', $model->attributes['720p'] ?:'disabled'=>"disabled"]),$mp4_path_mid) ?>
        <?= Html::a(Html::Button('标清', ['class' => 'btn btn-success', $model->attributes['480p'] ?:'disabled'=>"disabled"]),$mp4_path_low) ?>
    </div>
    </div>
  -->
    <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"
      poster="http://video-js.zencoder.com/oceans-clip.png"
      data-setup="{}">
    <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
    <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
    <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
    <track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
    <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>  
    <div class = 'col-lg-12'>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'filename',
            'create_at',
            'path',
            'uploader_id',
        ],
    ]) ?>
    </div>

</div>
