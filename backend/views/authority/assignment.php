<!--顶级栏目-->
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
                    <a href="<?= Url::toRoute(["/authority/add-user-assignment"]) ?>" type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 增加分配用户角色</a>
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
                                        <td class="qys-c66"><?= $value->roleName ?></td>
                                        <td class="qys-c66"><?= User::findOne($value->userId)->username ?></td>
                                        <td class="qys-c66"><?= date("Y-m-d", $value->createdAt) ?></td>
                                        <td class="qys-c66">
                                            <a href="<?= Url::toRoute(["/authority/edit-user-assignment", "role_name" => $value->roleName, "user_id" => $value->userId]) ?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 修改</a>
                                            <a href="<?= Url::toRoute(["/authority/del-user-assignment", "role_name" => $value->roleName, "user_id" => $value->userId]) ?>" onclick="return confirm('确定删除此用户角色?')" class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</a>
                                        </td>
                                    </tr>
                                    <?php $i = $i + 1 ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
</div>