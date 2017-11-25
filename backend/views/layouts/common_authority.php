<?php

use yii\helpers\Url;
?>
<div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">
        权限控制
    </div>
    <div class="tpl-left-nav-list">
        <ul class="tpl-left-nav-menu">
            <li class="tpl-left-nav-item">
                <a href="<?= Url::toRoute(['/site/index']) ?>" class="nav-link">
                    <i class="am-icon-home"></i>
                    <span>控制台</span>
                </a>
            </li>
            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-wpforms"></i>
                    <span>模块列表</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="<?= Url::toRoute(['/authority/index']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>模块列表</span>
                        </a>

                        <a href="<?= Url::toRoute(['/authority/add-column']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>添加模块</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-star"></i>
                    <span>栏目列表</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="<?= Url::toRoute(['/authority/sub-column']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>栏目列表</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-search"></i>
                    <span>角色列表</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="<?= Url::toRoute(['/authority/role']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>角色列表</span>
                        </a>

                        <a href="<?= Url::toRoute(['/authority/add-role']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>添加角色</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-archive"></i>
                    <span>权限列表</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="<?= Url::toRoute(['/authority/permission']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>权限列表</span>
                        </a>

                        <a href="<?= Url::toRoute(['/authority/add-permission']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>添加权限</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="tpl-left-nav-item">
                <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-key"></i>
                    <span>分配角色</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="<?= Url::toRoute(['/authority/assignment']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>角色列表</span>
                        </a>

                        <a href="<?= Url::toRoute(['/authority/add-user-assignment']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>添加分配</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
