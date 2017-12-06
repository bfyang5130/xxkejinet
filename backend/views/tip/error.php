<?php
/* @var $this yii\web\View */

use backend\assets\AppAsset;
use yii\helpers\Html ;

$this->title = '提示-' . Yii::$app->params['webname'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">提示</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="timeline-body text-center">
                    <h3> <?= nl2br(Html::encode($message)) ?></h3>
                    <br>
                </div>     
                <div class="timeline-footer text-center">
                </div>
            </div><!-- /.box-body -->
        </div>        
    </div>
</div><!--/span-->