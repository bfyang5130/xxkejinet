<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm ;
use yii\helpers\Url ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "角色分配权限" ;
$this->title = '角色分配权限-' . Yii::$app->params['webname'];
$role_name = Yii::$app->request->get("role_name") ;
$had_permission = \backend\service\RbacService::findPermissionsByRole($role_name);
$had_permission = \yii\helpers\ArrayHelper::map($had_permission,'name','description');
$permission = $model->getNewPermissions($role_name);
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
                          <h3 class="box-title">角色分配权限</h3>
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
                                <label  class="col-sm-4 control-label">角色名称：</label>
                                <div class="col-sm-4">
                                    <label  class="control-label"><?= $role_name?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">角色已有权限(选择并提交可删除)：</label>
                                <?= $form->field($model, 'had_permission')->dropDownList($had_permission,["multiple"=>true]); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">角色可增加权限：</label>
                                <?= $form->field($model, 'permission')->dropDownList($permission,["multiple"=>true]); ?>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary" style="width: 20%;">提交</button>
                        </div><!-- /.box-footer -->
                        <?= $form->field($model, 'name')->hiddenInput(["value"=>$role_name]); ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->