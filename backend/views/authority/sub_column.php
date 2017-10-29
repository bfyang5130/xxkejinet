<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use common\services\ColumnService;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::addPageScript($this, "/js/column.js");
$module_id = Yii::$app->request->get("module_id");
$page = 20;
$top_column_arr = ColumnService::findColumnList($page, 1, 0);
$pid_arr = [];
foreach ($top_column_arr['list'] as $value) {
    $pid_arr[] = $value['id'];
}
$pids = $module_id;
if (empty($pids)) {
    $pids = $pid_arr;
}
$column_arr = ColumnService::findColumnList($page, null, $pids);
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "栏目列表";
$this->title = '栏目列表-' . Yii::$app->params['webname'];
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
                    'label' => '浏览模块',
                    'url' => ['authority/sub-column']
                ]
            ],
        ]);
        ?>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-repeat"></i> </span>
                        <h5><?= $this->title ?></h5>
                        <a class="pull-right" href="<?= Url::toRoute(["/authority/add-column"]) ?>" title="增加模块"><span class="icon"> <i class="icon-plus"></i> 添加模块</span></a>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>标题</th>
                                    <th>顺序</th>
                                    <th>所属模块</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($column_arr['list'] as $value): ?>
                                    <tr>
                                        <td><?= $value['id'] ?></td>
                                        <td class="center"><?= $value['name'] ?></td>
                                        <td class="center"><?= $value['order'] ?></td>
                                        <td class="center"><?= $value['parent_name']; ?></td>
                                        <td class="center">
                                            <?php if ($value['status'] == 1): ?>
                                                启用
                                            <?php elseif ($value['status'] == 2): ?>
                                                暂停
                                            <?php else: ?>
                                                未知
                                            <?php endif; ?>
                                        </td>
                                        <td class="center">
                                            <a href="<?= Url::toRoute(["/column/upd-column", "column_id" => $value['id'], "module_id" => "column"]) ?>"><button class="btn btn-warning btn-mini">修改</button></a>
                                            <button class="btn btn-danger btn-mini del-btn" title="<?= $value['id'] ?>">删除</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="11" class="text-center">
                                        <?=
                                        \backend\widgets\BackCommonPage::widget([
                                            'pagination' => $top_column_arr['pages'],
                                            'maxButtonCount' => 8,
                                        ])
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>