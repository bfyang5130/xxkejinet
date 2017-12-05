<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "增加角色";
$this->title = '增加角色';
?>
<div class="tpl-content-wrapper">
    <?=
    Breadcrumbs::widget([
        'tag' => 'ol',
        'options' => ['class' => 'am-breadcrumb qys-breadcrumb'],
        'itemTemplate' => "<li>{link}</li>\n", // template for all links
        'homeLink' => [
            'label' => '控制台',
            'url' => ['site/index'],
            'template' => "<li>{link}</li>\n", // template for this link only
            'title' => '控制台',
            'class' => 'am-icon-home',
            'encode' => false
        ],
        'links' => [
            [
                'label' => $this->params['display_name'],
                'url' => ['authority/index']
            ]
        ],
    ]);
    ?>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption">
                <span class="am-icon-pencil"></span> <?= $this->title ?>
            </div>
        </div>
        <div class="tpl-block">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'column',
                                'fieldConfig' => ['template' => "{input}{error}", 'inputOptions' => ['class' => '']],
                                'options' => ["class" => "am-form am-form-horizontal"],
                    ]);
                    ?>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">角色名称 :</label>
                        <?= $form->field($model, 'name', ["template" => '<div class="am-u-sm-9">{input}<small>{error}</small></div>'])->textInput(); ?>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">角色描述 :</label>
                        <?= $form->field($model, 'desc', ["template" => '<div class="am-u-sm-9">{input}<small>{error}</small></div>'])->textInput(); ?>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="submit" class="am-btn am-btn-primary">提交</button>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
</div>