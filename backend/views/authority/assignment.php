<!--分配角色列表-->
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use backend\services\RbacService;
use backend\assets\AppAsset;
use common\models\User;
use yii\widgets\Breadcrumbs;

AppAsset::addPageScript($this, "/js/role.js");
$assignments = RbacService::findAssignments();
$i = 1;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "分配用户角色列表";
$this->title = '分配用户角色列表-' . Yii::$app->params['webname'];
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
                    'url' => ['authority/assignment']
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
                        <a class="pull-right" href="<?= Url::toRoute(["/authority/add-user-assignment"]) ?>" title="增加分配用户角色"><span class="icon"> <i class="icon-plus"></i> 增加分配用户角色</span></a>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>角色</th>
                                    <th>用户名</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($assignments as $assignment): ?>
                                    <?php foreach ($assignment as $key => $value): ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td class="center"><?= $value->roleName ?></td>
                                            <td class="center"><?= User::findOne($value->userId)->username ?></td>
                                            <td class="center"><?= date("Y-m-d", $value->createdAt) ?></td>
                                            <td class="center">
                                                <a href="<?= Url::toRoute(["/authority/edit-user-assignment", "role_name" => $value->roleName, "user_id" => $value->userId]) ?>"><button class="btn btn-warning btn-mini">编辑</button></a>
                                                <a href="<?= Url::toRoute(["/authority/del-user-assignment", "role_name" => $value->roleName, "user_id" => $value->userId]) ?>" onclick="return confirm('确定删除此用户角色?')"><button class="btn btn-danger btn-mini">删除</button></a>
                                            </td>
                                        </tr>
                                        <?php $i = $i + 1 ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>