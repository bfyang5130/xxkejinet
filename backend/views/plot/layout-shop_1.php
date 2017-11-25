<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\BPlotService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::addPageScript($this, "/js/column.js");
$page = 10;
$list_array = BPlotService::findUseExistList($page, null, 0);
$this->params['breadcrumbs'][] = "布局";
$this->params['display_name'] = "已用布局";
$this->title = '已用布局-' . Yii::$app->params['webname'];
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
                    'url' => ['plot/index']
                ]
            ],
        ]);
        ?>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs tab-click">
                            <li><span class="icon"><i class="icon-shopping-cart"></i></span></li>
                            <li class="layout_base_title"style="width:100px;"><h5>基本布局</h5></li>
                            <li class="active"><a>预览</a></li>
                            <li class=""><a>概述</a></li>
                            <li class=""><a>作者</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div class="tab-pane active">
                            <p>
                                <a class="thumbnail lightbox_trigger" href="/images/gallery/imgbox4.jpg">
                                    <img src="/images/gallery/imgbox4.jpg" alt="">
                                </a>
                            </p>

                        </div>
                        <div class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                        <div class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>