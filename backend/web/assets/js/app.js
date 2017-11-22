$(function () {

    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function () {
        $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function () {
        $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
    });
    $('.tpl-switch').find('.tpl-switch-btn-view').on('click', function () {
        $(this).prev('.tpl-switch-btn').prop("checked", function () {
            if ($(this).is(':checked')) {
                return false;
            } else {
                return true;
            }
        });
        // console.log('123123123')

    });
    //fit lestmenushow
    var showPath = window.location.pathname;
    if (showPath === '/') {
        showPath = '/site/index.html';
    }
    //check first menu
    var isTopLevel = 1;
    $(".tpl-left-nav-item").each(function () {
        isTheTopSelect = $(this).children('a');
        isTheTopSelectHref = isTheTopSelect.attr('href');
        if (isTheTopSelectHref === showPath) {
            $(isTheTopSelect).addClass('active');
            isTopLevel = 2;
        }
    });
    //check second menus
    if (isTopLevel === 1) {
        $(".tpl-left-nav-sub-menu").each(function () {
            isTheSubSelect = $(this).children('li').children('a');
            $(isTheSubSelect).each(function () {
                isTheSubSelectA = $(this);
                isTheSubSelectAHref = isTheSubSelectA.attr('href');
                if (isTheSubSelectAHref === showPath) {
                    $(isTheSubSelectA).addClass('active');
                    $(isTheSubSelectA).parent().parent().css('display', 'block');
                    $(isTheSubSelectA).parent().parent().prev().addClass('active');
                }
            });

        });
    }
});
// ==========================
// 侧边导航下拉列表
// ==========================

$('.tpl-left-nav-link-list').on('click', function () {
    $(this).siblings('.tpl-left-nav-sub-menu').slideToggle(80)
            .end()
            .find('.tpl-left-nav-more-ico').toggleClass('tpl-left-nav-more-ico-rotate');
});
// ==========================
// 头部导航隐藏菜单
// ==========================

$('.tpl-header-nav-hover-ico').on('click', function () {
    $('.tpl-left-nav').toggle();
    $('.tpl-content-wrapper').toggleClass('tpl-content-wrapper-hover');

});