<!--分配角色列表-->
<?php
/* @var $this yii\web\View */
use yii\helpers\Url ;
use backend\service\RbacService ;
use backend\assets\AppAsset ;
use common\models\User ;

AppAsset::addPageScript($this, "/js/role.js") ;
$assignments = RbacService::findAssignments() ;
$i = 1 ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "分配用户角色列表" ;
$this->title = '分配用户角色列表-' . Yii::$app->params['webname'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?= $this->render("common_bar")?>
                <li class="pull-right"><a href="<?= Url::toRoute(["/column/add-user-assignment"])?>" class="text-muted" title="增加分配用户角色"><i class="fa fa-plus"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-striped table-condensed">
                            <tbody>
                                <tr>
                                    <th>序号</th>
                                    <th>角色</th>
                                    <th>用户名</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                <?php foreach ($assignments as $assignment):?>
                                <?php foreach ($assignment as $key=>$value):?>
                                <tr>
                                    <td><?= $i?></td>
                                    <td class="center"><?= $value->roleName?></td>
                                    <td class="center"><?= User::findOne($value->userId)->username?></td>
                                    <td class="center"><?= date("Y-m-d",$value->createdAt)?></td>
                                    <td class="center">
									<a href="<?= Url::toRoute(["/column/edit-user-assignment","role_name"=>$value->roleName,"user_id"=>$value->userId])?>"><button class="btn btn-primary btn-xs">编辑</button></a>
									<a href="<?= Url::toRoute(["/column/del-user-assignment","role_name"=>$value->roleName,"user_id"=>$value->userId])?>" onclick="return confirm('确定删除此用户角色?')"><button class="btn btn-primary btn-xs">删除</button></a>
                                    </td>
                                </tr>
                                <?php $i=$i+1?>
                                <?php endforeach;?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->