<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use common\services\ColumnService;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;

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
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?= $this->render("common_bar")?>
                <li class="pull-right"><a href="<?= Url::toRoute(["/column/add-column", "module_id" => "column"]) ?>" class="text-muted" title="增加模块"><i class="fa fa-plus"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-striped table-condensed">
                            <tbody>
                                <tr>
                                    <th>序号</th>
                                    <th>标题</th>
                                    <th>顺序</th>
                                    <th>所属模块</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
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
                                            <a href="<?= Url::toRoute(["/column/upd-column", "column_id" => $value['id'], "module_id" => "column"]) ?>"><button class="btn btn-primary btn-xs">修改</button></a>
                                            <button class="btn btn-primary btn-xs del-btn" title="<?= $value['id'] ?>">删除</button>
                                        </td>
                                    </tr>
<?php endforeach; ?>
                                <tr>
                                    <td colspan="11" class="text-center">
                                        <?=
                                        LinkPager::widget([
                                            'firstPageLabel' => '首页',
                                            'lastPageLabel' => '末页',
                                            'prevPageLabel' => '上一页',
                                            'nextPageLabel' => '下一页',
                                            'pagination' => $column_arr['pages'],
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
</div><!--/span-->