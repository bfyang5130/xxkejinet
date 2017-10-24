<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
AppAsset::addPageCss($this, '/css/maruti-login.css');
AppAsset::addPageScript($this, '/js/maruti.login.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>