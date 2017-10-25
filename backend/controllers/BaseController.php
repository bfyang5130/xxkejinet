<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * 控制器基类,所有Controller继承此类,用于限制页面需要登陆才能访问
 */
class BaseController extends Controller {

    public function beforeAction($action) {
        $controller_name = $action->controller->id;
        $action_name = $action->id;
        $module_name = $action->controller->module->id ;
        if ($controller_name == "login" || $controller_name == "tip") {
            return parent::beforeAction($action);
        }
        if (Yii::$app->admin->isGuest) {
            $url = Url::to(['/login/index']);
            exit('<script>top.location.href="' . $url . '"</script>');
        }

        //admin用户不检查权限
        if (Yii::$app->admin->identity->username == "admin") {
            return parent::beforeAction($action);
        }
        //app-backend代表顶级的模块
        if($module_name=="app-backend"){
            $permissions_item =  $controller_name . "/" . $action_name;
        }else{
            $permissions_item = $module_name ."/" .$controller_name . "/" . $action_name;
        }
        if (Yii::$app->admin->can($permissions_item) == false) {
            throw new ForbiddenHttpException("您没有权限");
        }
        return parent::beforeAction($action);
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

    public function afterAction($action, $result) {
        $controller_name = $action->controller->id;

        $action_name = $action->id;
        if ($controller_name == "login" || $controller_name == "tip") {
            return parent::afterAction($action, $result);
        }
        $newOp = new \common\models\Operate();
        $newOp->operate_name = Yii::$app->admin->identity->username;
        $newOp->operate_page = \Yii::$app->request->absoluteUrl;
        $newOp->operate_time = date('Y-m-d H:i:s', time());
        $newOp->operate_ip = \Yii::$app->request->userIP;
        $newOp->save();
        return parent::afterAction($action, $result);
    }

}
