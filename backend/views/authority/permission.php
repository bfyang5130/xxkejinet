<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

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
                    'url' => ['authority/permission']
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
                        <a class="pull-right" href="<?= Url::toRoute(["/authority/add-permission"]) ?>" title="增加权限"><span class="icon"> <i class="icon-plus"></i> 添加角色</span></a>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>权限名</th>
                                    <th>描述</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permissions as $key => $value): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td class="center"><?= $value->name ?></td>
                                        <td class="center"><?= $value->description ?></td>
                                        <td class="center"><?= date("Y-m-d", $value->createdAt) ?></td>
                                        <td class="center"><a href="<?= Url::toRoute(["/authority/del-permission", "role_name" => $value->name]) ?>" onclick="return confirm('确定删除此权限?')"><button class="btn btn-danger btn-mini">删除</button></a></td>
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
</div>