<?php

namespace backend\controllers;

use Yii;
use backend\controllers\BaseController;
use yii\filters\VerbFilter;
use backend\models\form\LayoutForm;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * Site controller
 */
class ModController extends BaseController {

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
    public function actionModList() {
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
            //获得上传的文件
            $layout_ｂ_pic = UploadedFile::getInstance($model, 'layout_ｂ_pic');
            $layout_source = UploadedFile::getInstance($model, 'layout_source');
            //获得临时上传的实体
            $layout_ｂ_pic_obj = $layout_ｂ_pic->tempName;
            $layout_source_obj = $layout_source->tempName;
            //设定储的位置
            $layout_ｂ_pic_path = 'xxkeji/layout/layout_b_pic_' . date('YmdHis') . rand(10000, 99999) . '.' . $layout_ｂ_pic->getExtension();
            $layout_source_path = 'xxkeji/layout/layout_source_' . date('YmdHis') . rand(10000, 99999) . '.' . $layout_source->getExtension();
            //当同时上传成功时才做增加新数据
            if (\Yii::$app->Aliyunoss->upload($layout_ｂ_pic_path, $layout_ｂ_pic_obj) && \Yii::$app->Aliyunoss->upload($layout_source_path, $layout_source_obj)) {
                $model->layout_ｂ_pic = $layout_ｂ_pic_path;
                $model->layout_source = $layout_source_path;
                $add_rs = $model->save();
                return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/plot/layout-design"])]);
            } else {
                $model->addError('layout_ｂ_pic', '文件上传失败');
            }
        }
        return $this->render("publish_layout", ["model" => $model]);
    }

}
