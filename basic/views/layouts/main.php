<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\MessengerAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
MessengerAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            
            NavBar::begin([
                'brandLabel' => '视频分享Demo',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => '上传', 'url' => ['/video/create']],
                    ['label' => '列表', 'url' => ['/video/index']],
                    ['label' => '分类',  'items' => [
                            ['label' => '图书、音像、数字商品'],
                            ['label' => '家用电器'],
                            ['label' => '手机、数码、京东通信'],
                            ['label' => '电脑、办公'],
                            ['label' => '家居、家具、家装、厨具'],
                            ['label' => '男装、女装、内衣、珠宝'],
                            ['label' => '个护化妆'],
                            ['label' => '鞋靴、箱包、钟表、奢侈品'],
                            ['label' => '整车、汽车用品'],
                            ['label' => '母婴、玩具乐器'],
                            ['label' => '食品饮料、酒类、生鲜'],
                            ['label' => '营养保健'],
                            ['label' => '彩票、旅行、充值、票务'],
                        ]]
                ],
            ]);

            echo $this->render('_search');
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                        ['label' => '登陆', 'url' => ['/site/login']] :
                        ['label' => '登出 (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
