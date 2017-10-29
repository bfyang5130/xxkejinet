<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "分配用户角色" ;
$this->title = '分配用户角色-' . Yii::$app->params['webname'];
$role_name = Yii::$app->request->get("role_name") ;
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
                    'url' => ['authority/add-user-assignment']
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
                            <label class="control-label">用户名 :</label>
                            <?= $form->field($model, 'user_id', ["template" => '<div class="controls">{input}</div>'])->dropDownList($model->getUsers()); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">角色名 :</label>
                            <?= $form->field($model, 'rolename', ["template" => '<div class="controls">{input}</div>'])->dropDownList($model->getRoles()); ?>
                        </div>
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