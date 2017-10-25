<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm ;
use yii\helpers\Url ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "更新模块或栏目" ;
$this->title = '更新栏目-' . Yii::$app->params['webname'];
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
                          <h3 class="box-title">更新模块或栏目</h3>
                        </div><!-- /.box-header -->
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'column',
                            'fieldConfig' => ['template' => "{input}{error}",'options'=>['class'=>'col-sm-4']],
                            'options'=>["class"=>"form-horizontal"],
                        ])
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">栏目名称：</label>
                                <?= $form->field($model, 'name')->textInput(); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">所属栏目：</label>
                                <?= $form->field($model, 'pid')->dropDownList($model->getPidList()); ?>
                            </div>
                            <?php if(!empty($model->pid)):?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">类型：</label>
                                <?= $form->field($model, 'type')->dropDownList($model->getTypeList()); ?>
                            </div>
                            <?php endif;?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">标识：</label>
                                <?= $form->field($model, 'tag')->textInput(); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">参数：</label>
                                <?= $form->field($model, 'params')->textInput(); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">排序：</label>
                                <?= $form->field($model, 'order')->textInput(); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">状态：</label>
                                <?= $form->field($model, 'status')->dropDownList($model->getStatusList()); ?>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary" style="width: 20%;">提交</button>
                        </div><!-- /.box-footer -->
                        <?= $form->field($model, 'id')->hiddenInput(); ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->