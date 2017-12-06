<?php
/* @var $this yii\web\View */

use backend\assets\AppAsset;

$this->title = '提示-' . Yii::$app->params['webname'];
AppAsset::addPageScript($this, "/js/tip.js");
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
                    <h3><?php echo Yii::$app->request->get("msg") ;?></h3>
                    <br>
                </div>
                <?php if(!empty(Yii::$app->request->get("url"))):?>
                <div class="timeline-footer text-center">
                    <button to_url="<?php echo Yii::$app->request->get("url") ;?>" id="back_btn" class="btn btn-success btn-md" style="width: 20%;">返回</button>
                </div>
                <?php endif?>
            </div><!-- /.box-body -->
        </div>        
    </div>
</div><!--/span-->