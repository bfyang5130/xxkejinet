<?php
use yii\helpers\Url ;
?>
<?php $action = Yii::$app->controller->action->id ; ?>
<li class="<?=($action=='index')?'active':''?>"><a href="<?= Url::toRoute(["/column/index"]) ?>">模块列表</a></li>
<li class="<?=($action=='sub-column')?'active':''?>"><a href="<?= Url::toRoute(["/column/sub-column"])?>">栏目列表</a></li>
<li class="<?=($action=='role')?'active':''?>"><a href="<?= Url::toRoute(["/column/role"])?>">角色列表</a></li>
<li class="<?=($action=='permission')?'active':''?>"><a href="<?= Url::toRoute(["/column/permission"])?>">权限列表</a></li>
<li class="<?=($action=='assignment')?'active':''?>"><a href="<?= Url::toRoute(["/column/assignment"])?>">分配用户角色列表</a></li>
<li class="<?=($action=='crypt-des')?'active':''?>"><a href="<?= Url::toRoute(["/column/crypt-des"])?>">3des加解密</a></li>