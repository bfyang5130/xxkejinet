<?php

namespace backend\controllers;

use Yii;
use backend\controllers\BaseController;
use yii\filters\VerbFilter;

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
        $model = new \common\models\Layout(['scenario' => 'publish']);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('publish-layout', [
                    'model' => $model,
        ]);
    }

}
