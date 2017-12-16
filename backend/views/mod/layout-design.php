<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\BPlotService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

AppAsset::addPageScript($this, "/js/column.js");
//获得列表
$page = 10;
$list_array = BPlotService::findUserDesignLayoutList($page, null, \Yii::$app->admin->identity->user_id);
$this->params['breadcrumbs'][] = "布局";
$this->params['display_name'] = "我的设计";
$this->title = '我的设计';
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
                <span class="am-icon-bar-chart"></span> <?= $this->title ?>
            </div>
            <div class="am-u-sm-6 am-u-md-2 am-btn-toolbar am-topbar-right">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="<?= Url::toRoute(["/plot/publish-layout"]) ?>" type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 发布设计</a>
                </div>
            </div>
        </div>
        <div class="tpl-block">
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <?= Html::dropDownList('layout_type', '0', BPlotService::getLayoutType(), ['data-am-selected' => "{btnSize: 'sm'}"]) ?>
                    </div>
                </div>
            </div>
            <div class="am-g">
                <div class="tpl-table-images">
                    <?php foreach ($list_array['list'] as $value): ?>
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                            <div class="tpl-table-images-content">
                                <div class="tpl-table-images-content-i-time">发布时间：<?= $value['add_time'] ?></div>
                                <div class="tpl-i-title">
                                    <?= $value['layout_name'] ?>
                                </div>
                                <a href="javascript:;" class="tpl-table-images-content-i">
                                    <div class="tpl-table-images-content-i-info">
                                        <span class="ico">
                                            <img src="<?= \Yii::$app->params['aliyun_image_domail_replace'] . '/' . $value['layout_m_pic'] ?>" alt="<?= $value['layout_name'] ?>"><?= $value['layout_name'] ?>
                                        </span>

                                    </div>
                                    <span class="tpl-table-images-content-i-shadow"></span>
                                    <img src="<?= \Yii::$app->params['aliyun_image_domail_replace'] . '/' . $value['layout_b_pic'] ?>" alt="<?= $value['layout_name'] ?>">
                                </a>
                                <div class="tpl-table-images-content-block">
                                    <div class="tpl-i-font">
                                        <?= $value['layout_description'] ?>
                                    </div>
                                    <div class="tpl-i-more">
                                        <ul>
                                            <li><span class="am-badge tpl-badge-danger am-round">价格:<?= $value['layout_price'] ?></span></li>
                                            <li><span class="am-badge tpl-badge-danger am-round">模块:<?= $value['module_num'] ?></span></li>
                                        </ul>
                                    </div>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                            <?php
                                            if ($value['layout_status'] == 1):
                                                ?>
                                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-archive"></span> 已通过</button>
                                                <?php
                                            elseif ($value['layout_status'] == 2):
                                                ?>
                                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 不通过</button>
                                                <?php
                                            else:
                                                ?>
                                                <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 待审核</button>
                                            <?php
                                            endif;
                                            ?>
                                            <?php
                                            if ($value['layout_status'] != 1):
                                                ?>
                                                <button type="button" class="am-btn am-btn-default am-btn-primary"><span class="am-icon-trash-o"></span> 撤消</button>
                                                <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="am-u-lg-12">
                        <div class="am-cf">

                            <div class="am-fr">
                                <ul class="am-pagination tpl-pagination">
                                    <li class="am-disabled"><a href="#">«</a></li>
                                    <li class="am-active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                    </div>

                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
</div>