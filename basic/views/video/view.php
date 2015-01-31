<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->filename;
$this->params['breadcrumbs'][] = ['label' => '视频', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

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
