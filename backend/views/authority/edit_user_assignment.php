<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm ;
use yii\helpers\Url ;
use common\models\User ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "编辑用户角色" ;
$this->title = '编辑用户角色';
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
                          <h3 class="box-title">编辑用户角色</h3>
                        </div><!-- /.box-header -->
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'permission',
                            'fieldConfig' => ['template' => "{input}{error}",'options'=>['class'=>'col-sm-4']],
                            'options'=>["class"=>"form-horizontal"],
                        ])
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">用户名：</label>
								<span style="height:34px;font-weight:700;line-height:30px;float:left;padding-left:15px;"><?= User::findOne($user_id)->username?></span>
								<?= $form->field($model, 'user_id')->hiddenInput(["value"=>$user_id]); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">角色名：</label>
                                <?= $form->field($model, 'rolename')->dropDownList($model->getRoles()); ?>
                            </div>
							<?= $form->field($model, 'rolename_old')->hiddenInput(["value"=>$role_name]); ?>
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