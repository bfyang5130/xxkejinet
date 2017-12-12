<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\BPlotService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;

$page = 10;
$list_array = BPlotService::findUseExistList($page, null, 0);
$this->params['breadcrumbs'][] = "布局";
$this->params['display_name'] = "发布布局";
$this->title = '发布布局';
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
                'url' => ['plot/index']
            ]
        ],
    ]);
    ?>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> <?= $this->title ?>
            </div>
        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <?php
                    $form = ActiveForm::begin([
                                'fieldConfig' => ['template' => "{input}{error}", 'inputOptions' => ['class' => '']],
                                'options' => ["class" => "am-form am-form-horizontal", 'enctype' => 'multipart/form-data'],
                    ]);
                    ?>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">布局名称</label>
                        <div class="am-u-sm-9">
                            <?=
                                    $form->field($model, 'layout_name', ['options' => ['class' => ''], "template" => '{input}{error}'])
                                    ->textInput(["placeholder" => "输入布局名称"]);
                            ?>
                            <small>给您的布局起一个名字。</small>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">布局类型</label>
                        <div class="am-u-sm-9">
                            <?= $form->field($model, 'layout_type', ["template" => '{input}{error}'])->dropDownList($model->getLayoutType()); ?>
                            <small>选择你的布局类型</small>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-phone" class="am-u-sm-3 am-form-label">模块数量</label>
                        <div class="am-u-sm-9">
                            <?=
                                    $form->field($model, 'module_num', ['options' => ['class' => ''], "template" => '{input}{error}'])
                                    ->textInput(["placeholder" => "布局有多少个模块"]);
                            ?>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">定价</label>
                        <div class="am-u-sm-9">
                            <?=
                                    $form->field($model, 'layout_price', ['options' => ['class' => ''], "template" => '{input}{error}'])
                                    ->textInput(["placeholder" => "购买价格"]);
                            ?>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label"> 形象图(800*600) </label>
                        <div class="am-u-sm-9">
                            <?= $form->field($model, 'layout_ｂ_pic',['options' => [], "template" => '{input}{error}'])->fileInput(['class' => 'am-btn am-btn-success']) ?>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label"> 源代码(zip) </label>
                        <div class="am-u-sm-9">
                            <?= $form->field($model, 'layout_source',['options' => [], "template" => '{input}{error}'])->fileInput(['class' => 'am-btn am-btn-success']) ?>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-intro" class="am-u-sm-3 am-form-label">简介</label>
                        <div class="am-u-sm-9">
                            <?=
                                    $form->field($model, 'layout_description', ['options' => ['class' => '', 'rows' => '20'], "template" => '{input}{error}'])
                                    ->textarea(["placeholder" => "简介"]);
                            ?>
                            <small>简单最少100个字符,最多500个字符</small>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <input type="submit" class="am-btn am-btn-primary" value="发布" />
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>