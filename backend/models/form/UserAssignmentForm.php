<?php

namespace backend\models\form;

use yii\base\Model;
use backend\service\RbacService ;
use common\models\User ;
use Yii;

/**
 *  用户分配角色表单
 */
class UserAssignmentForm extends Model {
    
    public $user_id;
    public $rolename;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'rolename'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'user_id' => '用户ID',
            'rolename' => '角色名',
        ];
    }
    
    public function getRoles(){
        $roles = RbacService::findRoles() ;
        $role_arr = [] ;
        foreach ($roles as $value){
            $role_arr[$value->name]=$value->description ;
        }
        return $role_arr ;
    }
    
    public function getUsers(){
        $users = User::findAll(["type_id"=>2]) ;
        $user_arr = [] ;
        foreach ($users as $user){
            $user_arr[$user->user_id] = $user->username ;
        }
        return $user_arr ;
    }    
    
    public function addUserAssignment(){
        $add_rs = RbacService::addUserAssignment($this->user_id, $this->rolename) ;
        return $add_rs ;
    }
    
}
