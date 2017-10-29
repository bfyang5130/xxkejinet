<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "增加模块或栏目";
$this->title = '增加栏目-' . Yii::$app->params['webname'];
$module_id = Yii::$app->request->get("module_id");
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
                    'url' => ['authority/add-column']
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
                                    'id' => 'column',
                                    'fieldConfig' => ['template' => "{input}{error}", 'options' => ['class' => 'col-sm-4']],
                                    'options' => ["class" => "form-horizontal"],
                                ])
                        ?>
                        <div class="control-group">
                            <label class="control-label">栏目名称 :</label>
                            <?= $form->field($model, 'name', ["template" => '<div class="controls">{input}</div>'])->textInput(); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">所属栏目 :</label>
                            <?= $form->field($model, 'pid', ["template" => '<div class="controls">{input}</div>'])->dropDownList($model->getPidList()); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">类型 :</label>
                            <?= $form->field($model, 'type', ["template" => '<div class="controls">{input}</div>'])->dropDownList($model->getTypeList()); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">标识 :</label>
                            <?= $form->field($model, 'tag', ["template" => '<div class="controls">{input}</div>'])->textInput(); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">参数 :</label>
                            <?= $form->field($model, 'params', ["template" => '<div class="controls">{input}</div>'])->textInput(); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">排序 :</label>
                            <?= $form->field($model, 'order', ["template" => '<div class="controls">{input}</div>'])->textInput(); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">状态 :</label>
                            <?= $form->field($model, 'status', ["template" => '<div class="controls">{input}</div>'])->dropDownList($model->getStatusList()); ?>
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