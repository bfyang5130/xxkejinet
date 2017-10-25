<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$get_role_name = Yii::$app->request->get("role_name");
$role_name = "";
if (!empty($get_role_name)) {
    $role_name = $get_role_name;
}
$i = 1;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "{$role_name}权限列表";
$this->title = '权限列表-' . Yii::$app->params['webname'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?= $this->render("common_bar")?>
                <li class="pull-right"><a href="<?= Url::toRoute(["/column/add-permission"]) ?>" class="text-muted" title="增加权限"><i class="fa fa-plus"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-striped table-condensed">
                            <tbody>
                                <tr>
                                    <th>序号</th>
                                    <th>权限名</th>
                                    <th>描述</th>
                                    <th>添加时间</th>
									<th>操作</th>
                                </tr>
                                <?php foreach ($permissions as $key => $value): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td class="center"><?= $value->name ?></td>
                                        <td class="center"><?= $value->description ?></td>
                                        <td class="center"><?= date("Y-m-d", $value->createdAt) ?></td>
										<td class="center"><a href="<?= Url::toRoute(["/column/del-permission","role_name"=>$value->name])?>" onclick="return confirm('确定删除此权限?')"><button class="btn btn-primary btn-xs">删除</button></a></td>
                                    </tr>
                                    <?php $i = $i + 1 ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->