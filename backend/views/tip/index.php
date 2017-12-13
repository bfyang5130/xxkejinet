<?php
/* @var $this yii\web\View */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '提示-' . Yii::$app->params['webname'];
?>
<div class="tpl-content-wrapper">
    <ol class="am-breadcrumb">
        <li><a href="<?= Url::toRoute('/site/index'); ?>" class="am-icon-home">首页</a></li>
    </ol>
    <div class="tpl-content-scope">
        <div class="note note-info">
            <h3>提示
                <span class="close" data-close="note"></span>
            </h3>
            <p> <?= Html::decode(Yii::$app->request->get("msg")) ?></p>
            <?php if (!empty(Yii::$app->request->get("url"))): ?>
                <div class="timeline-footer text-center">
                    <a href="<?php echo Yii::$app->request->get("url"); ?>"  class="am-btn am-btn-success" style="width: 20%;">返回</a>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>