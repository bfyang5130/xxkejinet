<?php

//* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "角色分配权限";
$this->title = '角色分配权限';
$role_name = Yii::$app->request->get("role_name");
?>
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
                    'url' => ['authority/edit-role-permission']
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
                        <?php foreach ($column_all as $k => $val): ?>
                            <div class="control-group">
                                <label class="control-label"><?= $val['tag_name'] ?> :</label>
                                <div class="controls">
                                    <?php foreach ($edit_all as $key => $value): ?>
                                        <?php if ($val['tag'] == $value['column_name']): ?>
                                            <span><input name="RolePermissionForm[permission][]" type="checkbox" <?php if (in_array($value['name'], $edit_res)): ?>checked="checked"<?php endif; ?> style="vertical-align: text-bottom;" value="<?= $value['name'] ?>"/>&nbsp;&nbsp;<?= $value['description'] ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="controls-group">
                            <label class="control-label">其他模块 :</label>
                            <div class="controls">
                                <?php foreach ($edit_all as $key => $value): ?>
                                    <?php if (!in_array($value['column_name'], $column_alls)): ?>
                                        <span><input name="RolePermissionForm[permission][]" type="checkbox" <?php if (in_array($value['name'], $edit_res)): ?>checked="checked"<?php endif; ?> style="vertical-align: text-bottom;" value="<?= $value['name'] ?>"/>&nbsp;&nbsp;<?= $value['description'] ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
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