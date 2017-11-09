<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap-responsive.min.css',
    ];
    public $js = [
        "js/jquery-migrate-3.0.0.js",
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\widgets\ActiveFormAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

    //导入当前页的功能js文件，注意加载顺序，这个应该最后调用
    public static function addPageScript($view, $jsfile) {
        if (isset(\Yii::$app->params['dist_version'])) {
            //$jsfile = $jsfile . '?v=' . \Yii::$app->params['dist_version'];
            $jsfile = $jsfile . '?v=' . time();
        }
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }

    //导入当前页的功能css文件
    public static function addPageCss($view, $cssfile) {
        if (isset(\Yii::$app->params['dist_version'])) {
            //$cssfile = $cssfile . '?v=' . \Yii::$app->params['dist_version'];
            $cssfile = $cssfile . '?v=' . time();
        }
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }

}
