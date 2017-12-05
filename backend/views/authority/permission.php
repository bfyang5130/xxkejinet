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
$this->title = '权限列表';
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
                    <a href="<?= Url::toRoute(["/authority/add-permission"]) ?>" type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 添加角色</a>
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
                                    <td class="qys-c66"><?= $value->name ?></td>
                                    <td class="qys-c66"><?= $value->description ?></td>
                                    <td class="qys-c66"><?= date("Y-m-d", $value->createdAt) ?></td>
                                    <td class="qys-c66"><a href="<?= Url::toRoute(["/authority/del-permission", "role_name" => $value->name]) ?>" onclick="return confirm('确定删除此权限?')" class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</a></td>
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