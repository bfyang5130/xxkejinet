<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "角色分配权限";
$this->title = '角色分配权限';
$role_name = Yii::$app->request->get("role_name");
$had_permission = \backend\service\RbacService::findPermissionsByRole($role_name);
$had_permission = \yii\helpers\ArrayHelper::map($had_permission, 'name', 'description');
$permission = $model->getNewPermissions($role_name);
?>
<div id="content">
    <div id="content-header">
        <?=
        Breadcrumbs::widget([
            'tag' => 'div',
            'options' => ['id' => 'breadcrumb'],
            'itemTemplate' => "{link}\n", // template for all links
            'homeLink' => [
                'label' => '<i class="icon-home"></i> 我的站点',
                'url' => ['site/index'],
                'template' => "{link}\n", // template for this link only
                'title' => '我的站点',
                'class' => 'tip-bottom',
                'encode' => false
            ],
            'links' => [
                    [
                    'label' => $this->params['display_name'],
                    'url' => ['authority/add-role-permission']
                ]
            ],
        ]);
        ?>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-plus"></i>									
                        </span>
                        <h5><?= $this->title ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <?php
                        $form = ActiveForm::begin([
                                    'id' => 'permission',
                                    'fieldConfig' => ['template' => "{input}{error}", 'options' => ['class' => 'col-sm-4']],
                                    'options' => ["class" => "form-horizontal"],
                                ])
                        ?>
                        <div class="control-group">
                            <label class="control-label">角色名称 :</label>
                            <div class="controls"><?= $role_name ?></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">角色已有权限 :</label>
                            <?= $form->field($model, 'had_permission', ["template" => '<div class="controls">{input}</div>'])->dropDownList($had_permission, ["multiple" => true]); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">角色可增加权限 :</label>
                            <?= $form->field($model, 'permission', ["template" => '<div class="controls">{input}</div>'])->dropDownList($permission, ["multiple" => true]); ?>
                        </div>
                        <?= $form->field($model, 'name')->hiddenInput(["value" => $role_name]); ?>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">提交</button>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>						
            </div>
        </div>
    </div>
</div>