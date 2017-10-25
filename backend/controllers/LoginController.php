<?php

namespace backend\controllers;

use backend\services\AuthService;
use Yii;
use backend\models\form\LoginForm;
use yii\web\Cookie;

/**
 * 登陆登出类
 */
class LoginController extends BaseController {

    public $layout = "login";

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x5090c1,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 2,//间距
                'height'=>40,//高度
                'width' => 120,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>1,        //设置字符偏移量 有效果
            ],
        ];
    }
    /**
     * 登陆方法
     */
    public function actionIndex() {
        if(Yii::$app->admin->isGuest == false){
            return $this->goHome() ;
        }
        $model = new LoginForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->login()) {
            $username = Yii::$app->admin->identity->username ;
            $user_id = Yii::$app->admin->identity->user_id ;

            $url = AuthService::getUserLoginUrl($username,$user_id) ;

            $cookies = Yii::$app->response->cookies;
            $cookie = new Cookie();
            $cookie->name = 'defaultUrl';
            $cookie->value = $url ;
            $cookies->add($cookie);
            return $this->redirect(["site/index"]) ;
        }
        return $this->render('index', ["model" => $model]);
    }

    /**
     * 登出方法
     */
    public function actionLogout() {
        Yii::$app->admin->logout(false);
        $cookie = Yii::$app->request->cookies->get('googleAuthenticator');
        Yii::$app->response->getCookies()->remove($cookie);
        return $this->redirect(["login/index"]);
    }

}
