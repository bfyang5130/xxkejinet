<?php

namespace backend\models\form;

use yii\base\Model;
use backend\service\RbacService ;
use Yii;

/**
 *  角色表单
 */
class RoleForm extends Model {
    
    public $name;
    public $desc;
    public $orig_name ;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'desc'], 'required'],
            ['orig_name','safe'] ,
        ];
    }

    public function attributeLabels() {
        return [
            'name' => '名称',
            'tag' => '描述',
            'orig_name'=>'原始名称' ,
        ];
    }
    
    public function addRole(){
        $add_rs = RbacService::addRole($this->name, $this->desc) ;
        return $add_rs ;
    }
    
    public function updRole(){
        $upd_rs = RbacService::updRole($this->orig_name ,$this->name, $this->desc) ;
        return $upd_rs ;
    }    
    
}
