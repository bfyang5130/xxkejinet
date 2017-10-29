<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\widgets;

/**
 * Description of BackCommonPage
 *
 * @author qingyangsheng
 */
class BackCommonPage extends \yii\widgets\LinkPager {

    //put your code here
    public $firstPageLabel = '首页';
    public $lastPageLabel = '末页';
    public $prevPageLabel = '上一页';
    public $nextPageLabel = '下一页';
    /**
     * @var string the CSS class for the active (currently selected) page button.
     */
    public $activePageCssClass = 'ui-state-selectd-button';
    /**
     * @var string the CSS class for the disabled page buttons.
     */
    public $disabledPageCssClass = 'disabled';
    public $options=['class'=>'dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers','tag'=>'div'];
    public $linkContainerOptions=['tag'=>'sapn','class'=>'fg-button ui-button'];

}
