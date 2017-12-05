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
$this->title = '栏目列表';
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
            <div class="am-u-sm-6 am-u-md-2 am-btn-toolbar am-topbar-right">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="<?= Url::toRoute(["/authority/add-column"]) ?>" type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 添加模块</a>
                </div>
            </div>
        </div>
        <div class="tpl-block">
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-striped am-table-hover table-main">
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
                                    <td class="qys-c66"><?= $value['name'] ?></td>
                                    <td class="qys-c66"><?= $value['order'] ?></td>
                                    <td class="qys-c66"><?= $value['parent_name']; ?></td>
                                    <td class="qys-c66">
                                        <?php if ($value['status'] == 1): ?>
                                            启用
                                        <?php elseif ($value['status'] == 2): ?>
                                            暂停
                                        <?php else: ?>
                                            未知
                                        <?php endif; ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?= Url::toRoute(["/column/upd-column", "column_id" => $value['id'], "module_id" => "column"]) ?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 修改</a>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger del-btn" title="<?= $value['id'] ?>"><span class="am-icon-trash-o"></span> 删除</button>
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
                    <hr>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
</div>