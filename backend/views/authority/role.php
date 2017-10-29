<!--顶级栏目-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\RbacService;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::addPageScript($this, "/js/role.js");
$roles = RbacService::findRoles();
$i = 1;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "角色列表";
$this->title = '角色列表-' . Yii::$app->params['webname'];
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
                    'url' => ['authority/role']
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
                        <a class="pull-right" href="<?= Url::toRoute(["/authority/add-role"]) ?>" title="增加角色"><span class="icon"> <i class="icon-plus"></i> 添加角色</span></a>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>角色</th>
                                    <th>描述</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $key => $value): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td class="center"><?= $value->name ?></td>
                                        <td class="center"><?= $value->description ?></td>
                                        <td class="center"><?= date("Y-m-d", $value->createdAt) ?></td>
                                        <td class="center">
                                            <a href="<?= Url::toRoute(["/authority/permission", "role_name" => $key]) ?>"><button class="btn btn-primary btn-mini">浏览</button></a>
                                            <a href="<?= Url::toRoute(["/authority/edit-role-permission", "role_name" => $key]) ?>"><button class="btn btn-info btn-mini">权限操作</button></a>
                                            <a href="<?= Url::toRoute(["/authority/upd-role", "role_name" => $key]) ?>"><button class="btn btn-warning btn-mini">修改</button></a>
                                            <button class="btn btn-danger btn-mini del-btn del-role-btn" title="<?= $key ?>">删除</button>
                                        </td>
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