<?php

use yii\helpers\Url;
?>
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> 我的站点</a>
    <ul>
        <li class="active"><a href="<?= Url::toRoute(['/site/index']) ?>"><i class="icon icon-home"></i> <span>我的站点</span></a></li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>我的布局</span>　</a>
            <ul>
                <li><a href="<?= Url::toRoute(['/plot/index']) ?>">站点布局</a></li>
                <li><a href="form-validation.html">已购布局</a></li>
                <li><a href="<?= Url::toRoute(['/plot/layout-shop']) ?>">布局商城</a></li>
                <li>--前端开发者--</li>
                <li><a href="form-wizard.html">布局设计</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-retweet"></i> <span>我的模块</span>　</a>
            <ul>
                <li><a href="form-common.html">站点模块</a></li>
                <li><a href="form-validation.html">已购模块</a></li>
                <li><a href="form-wizard.html">模块商城</a></li>
                <li>--前端开发者--</li>
                <li><a href="form-wizard.html">后端设计</a></li>
                <li><a href="form-wizard.html">前端设计</a></li>
                <li>--模块开发者--</li>
                <li><a href="form-wizard.html">功能设计</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th"></i> <span>内容管理</span>　</a>
            <ul>
                <li><a href="form-common.html">站点模块</a></li>
                <li><a href="form-validation.html">已有模块</a></li>
                <li><a href="form-wizard.html">模块商城</a></li>
            </ul>
        </li>
    </ul>
</div>