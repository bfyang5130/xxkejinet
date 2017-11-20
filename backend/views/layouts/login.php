<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
AppAsset::addPageCss($this, '/css/qys.css');
AppAsset::addPageScript($this, 'assets/js/app.js');
$this->title = "寻想网络科技";
?>
<!doctype html>
<head>
<html lang="<?= Yii::$app->language ?>">
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <?php $this->head() ?>
</head>

<body data-type="login">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?= $this->render('common_footer') ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
