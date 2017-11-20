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
                    <a href="<?= Url::toRoute(["/authority/add-role"]) ?>" type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 增加角色</a>
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
                                <th>描述</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $key => $value): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td class="qys-c66"><?= $value->name ?></td>
                                    <td class="qys-c66"><?= $value->description ?></td>
                                    <td class="qys-c66"><?= date("Y-m-d", $value->createdAt) ?></td>
                                    <td class="qys-c66">
                                        <a href="<?= Url::toRoute(["/authority/permission", "role_name" => $key]) ?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-archive"></span> 浏览</a>
                                        <a href="<?= Url::toRoute(["/authority/edit-role-permission", "role_name" => $key]) ?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-key"></span> 权限操作</a>
                                        <a href="<?= Url::toRoute(["/authority/upd-role", "role_name" => $key]) ?>" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 修改</a>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger del-btn del-role-btn" title="<?= $key ?>">删除</button>
                                    </td>
                                </tr>
                                <?php $i = $i + 1 ?>
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