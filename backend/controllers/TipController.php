<?php

namespace backend\controllers;

use Yii;

/**
 * 提示类
 */
class TipController extends BaseController {

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * 提示页面
     */
    public function actionIndex() {
        return $this->render("index") ;
    }

    /**
     * 错误页面
     */
    public function actionError() {
        return $this->render("error") ;
    }

}
