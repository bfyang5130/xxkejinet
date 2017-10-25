<?php

namespace backend\models\form;

use common\models\Admin;
use yii\base\Model;
use common\services\BaseToolService;
use Yii;

/**
 *  登陆表单
 */
class LoginForm extends Model {

    const ADMIN_USER = 2 ;

    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'min' => 4],
            ['password', 'validatePassword'],
            ['verifyCode', 'captcha','captchaAction'=>'/login/captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'verifyCode'=>'验证码',
        ] ;
    }

    public function validatePassword() {
        $user = $this->getUser();
        if (empty($user)) {
            $this->addError("username", "用户不存在");
            return false;
        }
        if (BaseToolService::encodePassword($user->password_order, $this->password) !== $user->password) {
            $this->addError("password", "密码错误");
            return false;
        }
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->admin->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 1 : 0);
        } else {
            return false;
        }
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = Admin::findOne(["username"=>$this->username,"type_id"=>self::ADMIN_USER]);
        }
        return $this->_user;
    }

}
