<?php

namespace backend\models\form;

use yii\base\Model;
use backend\service\RbacService ;
use Yii;

/**
 *  权限表单
 */
class PermissionForm extends Model {
    
    public $name;
    public $desc;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'desc'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => '权限名称',
            'desc' => '描述',
        ];
    }
    
    public function addPermission(){
        $add_rs = RbacService::addPermission($this->name, $this->desc) ;
        return $add_rs ;
    }
    
}
