<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm ;
use yii\helpers\Url ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "角色分配权限" ;
$this->title = '角色分配权限-' . Yii::$app->params['webname'];
$role_name = Yii::$app->request->get("role_name") ;
?>
<style type="text/css">
.edit_role{
	list-style:none;
	width: 799px;
    float: left;
	margin-left: -25px;
}
.edit_role li{
	font-size: 12px;
    margin-right: 20px;
    line-height: 35px;
	width: 750px;
    overflow: auto;
}
.edit_role li span{
    margin-left: 15px;
}
</style>
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
                          <h3 class="box-title">角色权限编辑</h3>
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
                                <label class="col-sm-4 control-label">权限管理：</label>
                                <ul class="edit_role">
								<?php foreach ($column_all as $k => $val): ?>
									<li>
										<div style="width: 80px; float:left;"><label><?= $val['tag_name']?>:</label></div>
										<div style="width: 600px; float:left;">
										<?php foreach ($edit_all as $key => $value): ?>
										<?php if($val['tag']==$value['column_name']):?>
										<span><input name="RolePermissionForm[permission][]" type="checkbox" <?php if(in_array($value['name'],$edit_res)):?>checked="checked"<?php endif ;?> style="vertical-align: text-bottom;" value="<?= $value['name'] ?>"/>&nbsp;&nbsp;<?= $value['description'] ?></span>
										<?php endif ;?>
										<?php endforeach; ?>
										</div>
									</li>
								<?php endforeach; ?>
									<li>
										<div style="width: 80px; float:left;"><label>其他模块:</label></div>
										<div style="width: 600px; float:left;">
										<?php foreach ($edit_all as $key => $value): ?>
										<?php if(!in_array($value['column_name'],$column_alls)):?>
										<span><input name="RolePermissionForm[permission][]" type="checkbox" <?php if(in_array($value['name'],$edit_res)):?>checked="checked"<?php endif ;?> style="vertical-align: text-bottom;" value="<?= $value['name'] ?>"/>&nbsp;&nbsp;<?= $value['description'] ?></span>
										<?php endif ;?>
										<?php endforeach; ?>
										</div>
									</li>
								</ul>
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