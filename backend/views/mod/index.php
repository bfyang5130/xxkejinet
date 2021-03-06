<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\BPlotService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::addPageScript($this, "/js/column.js");
$page = 10;
//$list_array = BPlotService::findUseExistList($page, null, 0);
$this->params['breadcrumbs'][] = "布局";
$this->params['display_name'] = "已用布局";
$this->title = '已用布局-' . Yii::$app->params['webname'];
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
                <span class="am-icon-code"></span> 列表
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-small input-inline">
                    <div class="input-icon right">
                        <i class="am-icon-search"></i>
                        <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                </div>
            </div>


        </div>
        <div class="tpl-block">
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                            <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm'}" style="display: none;">
                            <option value="option1">所有类别</option>
                            <option value="option2">IT业界</option>
                            <option value="option3">数码产品</option>
                            <option value="option3">笔记本电脑</option>
                            <option value="option3">平板电脑</option>
                            <option value="option3">只能手机</option>
                            <option value="option3">超极本</option>
                        </select><div class="am-selected am-dropdown" id="am-selected-hduur" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-sm am-btn-default">    <span class="am-selected-status am-fl">所有类别</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content" style="min-width: 200px;">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="am-checked" data-index="0" data-group="0" data-value="option1">         <span class="am-selected-text">所有类别</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="1" data-group="0" data-value="option2">         <span class="am-selected-text">IT业界</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="2" data-group="0" data-value="option3">         <span class="am-selected-text">数码产品</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="3" data-group="0" data-value="option3">         <span class="am-selected-text">笔记本电脑</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="4" data-group="0" data-value="option3">         <span class="am-selected-text">平板电脑</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="5" data-group="0" data-value="option3">         <span class="am-selected-text">只能手机</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="6" data-group="0" data-value="option3">         <span class="am-selected-text">超极本</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field">
                        <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button"></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="am-g">
                <div class="tpl-table-images">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="tpl-table-images-content">
                            <div class="tpl-table-images-content-i-time">发布时间：2016-09-12</div>
                            <div class="tpl-i-title">
                                “你的旅行，是什么颜色？” 晒照片，换北欧梦幻极光之旅！
                            </div>
                            <a href="javascript:;" class="tpl-table-images-content-i">
                                <div class="tpl-table-images-content-i-info">
                                    <span class="ico">
                                        <img src="assets/img/user02.png" alt="">追逐
                                    </span>

                                </div>
                                <span class="tpl-table-images-content-i-shadow"></span>
                                <img src="assets/img/a1.png" alt="">
                            </a>
                            <div class="tpl-table-images-content-block">
                                <div class="tpl-i-font">
                                    你最喜欢的艺术作品，告诉大家它们的------名图画，色彩，交织，撞色，线条雕塑装置当代古代现代作品的照片。
                                </div>
                                <div class="tpl-i-more">
                                    <ul>
                                        <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                        <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                        <li><span class="am-icon-github font-green"> 600+</span></li>
                                    </ul>
                                </div>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> 编辑</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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