<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\BPlotService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
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
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-align-justify"></i>									
                        </span>
                        <h5>发布设计布局</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">布局名称:</label>
                                <div class="controls">
                                    <input type="text" class="span20" placeholder="请输入要发布的布局名称">
                                    <span class="help-block">Description field</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">类型:</label>
                                <div class="controls ">
                                    <div class="select2-container" id="s2id_autogen1">    <a href="#" onclick="return false;" class="select2-choice" tabindex="0">   <span>Third option</span><abbr class="select2-search-choice-close" style="display:none;"></abbr>   <div><b></b></div></a><div class="select2-drop select2-with-searchbox select2-offscreen" style="display: block;">   <div class="select2-search">       <input type="text" autocomplete="off" class="select2-input" tabindex="0">   </div>   <ul class="select2-results"></ul></div>    </div><select style="display: none;">
                                        <option>First option</option>
                                        <option>Second option</option>
                                        <option>Third option</option>
                                        <option>Fourth option</option>
                                        <option>Fifth option</option>
                                        <option>Sixth option</option>
                                        <option>Seventh option</option>
                                        <option>Eighth option</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">模块数量:</label>
                                <div class="controls">
                                    <input type="text" class="span20" placeholder="Enter Description (span20)">
                                    <span class="help-block">Description field</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">布局描述:</label>
                                <div class="controls">
                                    <textarea class="span20" placeholder="textarea (span20)"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">源文件:</label>
                                <div class="controls">
                                    <div class="uploader" id="uniform-undefined"><input type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
                                </div>
                            </div>
                            <div class="form-actions text_center">
                                <button type="submit" class="btn btn-success">发布</button>
                            </div>
                        </form>
                    </div>
                </div>						
            </div>
        </div>
    </div>
</div>