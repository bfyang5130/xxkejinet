<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm ;
use yii\helpers\Url ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "增加权限" ;
$this->title = '增加权限-' . Yii::$app->params['webname'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?= $this->render("common_bar")?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-success">
                        <div class="box-header with-border text-center">
                          <h3 class="box-title">增加权限</h3>
                        </div><!-- /.box-header -->
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'role',
                            'fieldConfig' => ['template' => "{input}{error}",'options'=>['class'=>'col-sm-4']],
                            'options'=>["class"=>"form-horizontal"],
                        ])
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">权限名称：</label>
                                <?= $form->field($model, 'name')->textInput(); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">权限描述：</label>
                                <?= $form->field($model, 'desc')->textInput(); ?>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary" style="width: 20%;">提交</button>
                        </div><!-- /.box-footer -->
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->