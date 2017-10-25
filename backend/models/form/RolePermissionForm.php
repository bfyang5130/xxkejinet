<?php

namespace backend\models\form;

use yii\base\Model;
use backend\service\RbacService ;
use Yii;
use yii\db\Query;
use \common\models\AuthItemChild;

/**
 *  角色权限表单
 */
class RolePermissionForm extends Model {
    
    public $name;
    public $permission;
    public $had_permission;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['permission','had_permission'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => '名称',
            'permission' => '权限',
            'had_permission' =>'已有权限'
        ];
    }
    
    public function getNewPermissions($role_name){
        $new_premission = RbacService::findNewPermissions($role_name) ;
        return $new_premission ;
    }
    
    public function addRolePermission(){
        if(empty($this->permission)&&empty($this->had_permission)){
            return ["status"=>true,"msg"=>"请选择要增加或删除的权限"] ;
        }
        $add_rs = null;
        $item_child = null;
        if(!empty($this->permission)){
            $add_rs = RbacService::addRolePermissions($this->name, $this->permission) ;
            if($add_rs == false){
                return $add_rs ;
            }
        }
        if(!empty($this->had_permission)){
            $item_child = RbacService::delPermissions($this->name,$this->had_permission);
            if($item_child == false){
                return $item_child ;
            }
        }
        if(!empty($add_rs) && !empty($item_child)){
            return ["status"=>true,"msg"=>"操作成功"] ;
        }else{
            return  !empty($add_rs)?$add_rs:$item_child;
        }
    }
}