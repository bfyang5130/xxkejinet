<?php
use yii\helpers\Url;
?>
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> 我的站点</a>
    <ul>
        <li class="active"><a href="<?= Url::toRoute(['/site/index']) ?>"><i class="icon icon-home"></i> <span>我的站点</span></a></li>
        <li class="submenu"> <a href="#"><i class="icon icon-th"></i> <span>模块列表</span>　</a>
            <ul>
                <li><a href="<?= Url::toRoute(['/authority/index']) ?>">模块列表</a></li>
                <li><a href="<?= Url::toRoute(['/authority/add-column']) ?>">添加模块</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>栏目列表</span>　</a>
            <ul>
                <li><a href="form-common.html">栏目列表</a></li>
                <li><a href="form-validation.html">添加栏目</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-plane"></i> <span>角色列表</span>　</a>
            <ul>
                <li><a href="form-common.html">角色列表</a></li>
                <li><a href="form-validation.html">添加角色</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-lock"></i> <span>权限列表</span>　</a>
            <ul>
                <li><a href="form-common.html">权限列表</a></li>
                <li><a href="form-validation.html">新增权限</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>分配角色</span>　</a>
            <ul>
                <li><a href="form-common.html">分配列表</a></li>
                <li><a href="form-validation.html">新增分配</a></li>
            </ul>
        </li>
    </ul>
</div>