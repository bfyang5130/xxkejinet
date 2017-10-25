<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "au_user".
 *
 * @property string $user_id
 * @property integer $type_id
 * @property string $password_order
 * @property string $username
 * @property string $password
 * @property string $paypassword
 * @property integer $islock
 * @property integer $invite_userid
 * @property string $invite_name
 * @property string $invite_money
 * @property integer $real_status
 * @property string $card_type
 * @property string $card_id
 * @property string $nation
 * @property string $realname
 * @property integer $status
 * @property integer $email_status
 * @property string $phone_status
 * @property string $email
 * @property integer $sex
 * @property string $litpic
 * @property string $tel
 * @property string $phone
 * @property string $question
 * @property string $answer
 * @property string $birthday
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $regtaken
 * @property integer $regativetime
 * @property string $repstaken
 * @property integer $repsativetime
 * @property integer $logintime
 * @property integer $addtime
 * @property string $addip
 * @property integer $uptime
 * @property string $upip
 * @property integer $lasttime
 * @property string $lastip
 * @property string $occupation
 * @property string $agent_level
 */
class Admin extends ActiveRecord implements IdentityInterface {
    
    public $auth_key ;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type_id', 'islock', 'real_status', 'status', 'email_status', 'sex', 'regativetime', 'repsativetime', 'logintime', 'addtime', 'uptime', 'lasttime','agent_level','invite_userid'], 'integer'],
            [['password_order'], 'string', 'max' => 6],
            [['username'], 'string', 'max' => 30],
            [['password', 'paypassword', 'card_id', 'phone_status', 'tel', 'phone', 'addip', 'upip'], 'string', 'max' => 50],
            [['invite_name'], 'string', 'max' => 30],
            [['invite_money', 'card_type', 'nation', 'question'], 'string', 'max' => 10],
            [['realname', 'province', 'city', 'area', 'lastip'], 'string', 'max' => 20],
            [['email', 'answer'], 'string', 'max' => 100],
            [['litpic'], 'string', 'max' => 250],
            [['address', 'regtaken', 'repstaken','occupation'], 'string', 'max' => 200],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'user_id' => 'User ID',
            'type_id' => '用户类型 1-普通用户 2-后台管理员',
            'password_order' => '用户加密密钥',
            'username' => '用户名称',
            'password' => '密码',
            'paypassword' => '支付密码',
            'islock' => '是否锁定 0-正常 1-锁定',
            'invite_userid' => '邀请好友',
            'invite_name' => '邀请人',
            'invite_money' => '邀请注册提成',
            'real_status' => '是否实名认证',
            'card_type' => '证件类型 1-身份证',
            'card_id' => '证件号码',
            'nation' => '民族',
            'realname' => '真实姓名',
            'status' => '用户状态',
            'email_status' => '邮件验证状态',
            'phone_status' => '手机验证状态',
            'email' => '邮箱',
            'sex' => '姓别 0-未设置 1-男 2-女',
            'litpic' => '头像',
            'tel' => '电话',
            'phone' => '手机号码',
            'question' => '安全问题',
            'answer' => '安全问题答案',
            'birthday' => '生日',
            'province' => '省',
            'city' => '市',
            'area' => '地区',
            'address' => '地址',
            'regtaken' => '邮件激活配对字符串',
            'regativetime' => '发送激活邮件的时间',
            'repstaken' => '重设密码标识',
            'repsativetime' => '重置密码有效时间',
            'logintime' => '登陆时间',
            'addtime' => '添加时间',
            'addip' => '添加IP',
            'uptime' => '更新时间',
            'upip' => '更新IP',
            'lasttime' => '最后一次登陆时间',
            'lastip' => '最后一次登陆IP',
            'occupation'=> '职业',
            'agent_level'=>'代理级别',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($user_id) {
        return static::findOne(['user_id' => $user_id,'type_id'=>2]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = NULL) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username,'type_id'=>2]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
//        if (!static::isPasswordResetTokenValid($token)) {
//            return null;
//        }
//
//        return static::findOne([
//                    'password_reset_token' => $token,
//                    'status' => self::STATUS_ACTIVE,
//        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
//        if (empty($token)) {
//            return false;
//        }
//        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
//        $parts = explode('_', $token);
//        $timestamp = (int) end($parts);
//        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
    
    public function getAccount(){
        return $this->hasOne(Account::className(),  ['user_id' => 'user_id']) ;
    }    

}
