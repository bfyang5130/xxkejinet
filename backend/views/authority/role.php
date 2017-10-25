<!--顶级栏目-->
<?php
/* @var $this yii\web\View */
use yii\helpers\Url ;
use backend\service\RbacService ;
use backend\assets\AppAsset ;

AppAsset::addPageScript($this, "/js/role.js") ;
$roles = RbacService::findRoles() ;
$i = 1 ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "角色列表" ;
$this->title = '角色列表-' . Yii::$app->params['webname'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?= $this->render("common_bar")?>
                <li class="pull-right"><a href="<?= Url::toRoute(["/column/add-role"])?>" class="text-muted" title="增加角色"><i class="fa fa-plus"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-striped table-condensed">
                            <tbody>
                                <tr>
                                    <th>序号</th>
                                    <th>角色</th>
                                    <th>描述</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                <?php foreach ($roles as $key=>$value):?>
                                <tr>
                                    <td><?= $i?></td>
                                    <td class="center"><?= $value->name?></td>
                                    <td class="center"><?= $value->description?></td>
                                    <td class="center"><?= date("Y-m-d",$value->createdAt)?></td>
                                    <td class="center">
                                        <a href="<?= Url::toRoute(["/column/permission","role_name"=>$key])?>"><button class="btn btn-primary btn-xs">浏览</button></a>
                                        <!--<a href="<?= Url::toRoute(["/column/add-role-permission","role_name"=>$key])?>"><button class="btn btn-primary btn-xs">增加权限</button></a>-->
										<a href="<?= Url::toRoute(["/column/edit-role-permission","role_name"=>$key])?>"><button class="btn btn-primary btn-xs">权限操作</button></a>
                                        <a href="<?= Url::toRoute(["/column/upd-role","role_name"=>$key])?>"><button class="btn btn-primary btn-xs">修改</button></a>
                                        <button class="btn btn-primary btn-xs del-role-btn" title="<?= $key?>">删除</button>
                                    </td>
                                </tr>
                                <?php $i=$i+1?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->