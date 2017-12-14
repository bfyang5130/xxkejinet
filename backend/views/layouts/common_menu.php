<?php

use yii\helpers\Url;
?>
<div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">
        导航栏
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
                    <span>我的布局</span>
                    <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                </a>
                <ul class="tpl-left-nav-sub-menu">
                    <li>
                        <a href="<?= Url::toRoute(['/plot/layout-shop']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>布局商城</span>
                        </a>

                        <a href="<?= Url::toRoute(['/plot/layout-design']) ?>">
                            <i class="am-icon-angle-right"></i>
                            <span>我的设计</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>