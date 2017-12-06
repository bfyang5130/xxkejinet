<?php

namespace backend\controllers;

use Yii;
use backend\controllers\BaseController;
use yii\filters\VerbFilter;
use backend\models\form\LayoutForm;
/**
 * Site controller
 */
class PlotController extends BaseController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLayoutShop() {
        return $this->render('layout-shop');
    }

    /**
     * Displays user design.
     *
     * @return string
     */
    public function actionLayoutDesign() {
        return $this->render('layout-design');
    }

    /**
     * Displays user design.
     *
     * @return string
     */
    public function actionPublishLayout() {
        
        $model = new LayoutForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            //$add_rs = $model->addColumn();
            //if ($add_rs['status'] == true) {
            //    RbacService::addPermissionbyColumn($model->pid, $model->tag);
            //}
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/index"])]);
        }
        return $this->render("publish_layout", ["model" => $model]);
    }

}
