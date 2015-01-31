<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\assets\WaterFallAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

WaterFallAsset::register($this);

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="video-index">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "",
        'pager' => ['options'=>['class'=>'hidden']],
        'itemOptions' => ['class' => 'item col-sm-3'],
        'itemView' => function ($model, $key, $index, $widget) {
            $a2 = Html::a(Html::encode($model->filename), ['view', 'md5' => $model->md5]);

            $NoImage = Html::tag('p',$a2,["class"=>"NoImage"]);
            $p = Html::tag('p',"【灵感库】文字、图形、人物三个元素穿插成的海报设计，学习学习。Design By Anthony Neil Dart",["class"=>"description"]);
           // $p = "";
            $attribution = Html::tag('div',$NoImage,['class'=>'attribution']);

            $img = Html::img('/files/thumbnail/'.$model->thumbnail,['class'=>"img-responsive"]);
            $a = Html::a($img, ['view', 'md5' => $model->md5]);

            $div = Html::tag('div',$a.$p.$attribution,["class"=>'pin']);      
            return $div;
        },
    ]) ?>
</div>

