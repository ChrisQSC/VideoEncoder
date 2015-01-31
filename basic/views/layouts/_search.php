<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search  col-sm-3 navbar-form navbar-right">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="input-group">
        <input type="text" id="videosearch-filename" class="form-control" name="VideoSearch[filename]" placeholder="视频名称/作者">
        <span class="input-group-btn">
        <?= Html::submitButton('查找', ['class' => 'btn btn-primary']) ?>
        </span>
    </div>
    <?php ActiveForm::end(); ?>

</div>
