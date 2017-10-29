<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use common\services\ColumnService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::addPageScript($this, "/js/column.js");
$page = 10;
$top_column_arr = ColumnService::findColumnList($page, null, 0);
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "模块列表";
$this->title = '模块列表-' . Yii::$app->params['webname'];
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
                    'url' => ['authority/index']
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
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top_column_arr['list'] as $value): ?>
                                    <tr>
                                        <td><?= $value['id'] ?></td>
                                        <td class="center"><?= $value['name'] ?></td>
                                        <td class="center"><?= $value['order'] ?></td>
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
                                            <a href="<?= Url::toRoute(["/authority/sub-column", "module_id" => $value['id']]) ?>"><button class="btn btn-primary btn-mini">浏览</button></a>
                                            <a href="<?= Url::toRoute(["/authority/add-column", "module_id" => $value['id']]) ?>"><button class="btn btn-success btn-mini">增加栏目</button></a>
                                            <a href="<?= Url::toRoute(["/authority/upd-column", "column_id" => $value['id']]) ?>"><button class="btn btn-warning btn-mini">修改</button></a>
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