<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "增加角色";
$this->title = '增加角色-' . Yii::$app->params['webname'];
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
                    'url' => ['authority/add-role']
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
                                    'id' => 'role',
                                    'fieldConfig' => ['template' => "{input}{error}", 'options' => ['class' => 'col-sm-4']],
                                    'options' => ["class" => "form-horizontal"],
                                ])
                        ?>
                        <div class="control-group">
                            <label class="control-label">角色名称 :</label>
                            <?= $form->field($model, 'name', ["template" => '<div class="controls">{input}</div>'])->textInput(); ?>
                        </div>
                        <div class="control-group">
                            <label class="control-label">角色描述 :</label>
                            <?= $form->field($model, 'desc', ["template" => '<div class="controls">{input}</div>'])->textInput(); ?>
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