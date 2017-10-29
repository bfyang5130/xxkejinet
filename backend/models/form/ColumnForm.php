<?php

namespace backend\models\form;

use yii\base\Model;
use app\models\Column ;
use common\services\ColumnService ;
use Yii;

/**
 *  栏目表单
 */
class ColumnForm extends Model {
    
    public $id ;
    public $name;
    public $tag;
    public $pid ;
    public $order ;
    public $status ;
    public $addtime ;
    public $addip;
    public $params ;
    public $type ;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pid', 'status', 'addtime' ,'order'], 'integer'],
            [['tag', 'addip'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 60],
            [['name'], 'string', 'max' => 60],
            [['params','type'], 'string', 'max' => 255],
            ['id','safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => '名称',
            'tag' => '标识',
            'pid' => '所属模块 1-顶级 2-子级',
            'status' => '1-启用 2-暂停',
            'order'=>'顺序',
            'addtime' => '增加时间',
            'addip' => '增加的IP',
            'params'=> '参数',
            'type'=> '类型',
        ];
    }
    
    public function getStatusList(){
        return [
            '1'=>"开启" ,
            '2'=>'暂停' ,
        ] ;
    }        
    
    public function getPidList(){
        $module_id = Yii::$app->request->get("module_id") ;
        if(empty($module_id)){
            $column_select = ['0'=>'顶级栏目'] ;
        }elseif($module_id=="column") {
            $column_select = [] ;
            $column_arr = ColumnService::findColumnList(null, 1, 0) ;
            foreach ($column_arr['list'] as $value){
                $column_select[$value['id']] = $value['name'];
            }            
        }else{
            $column = ColumnService::findColumnById($module_id) ;
            $column_select = [$module_id=>$column['name']] ;
        }
        return $column_select ;
    }
    
    public function getUptPidList(){
        $column_arr = ColumnService::findColumnList(null, 1,0) ;
        $column_list = $column_arr['list'] ;
        $column_select = ['0'=>'顶级栏目'] ;
        $sub_column = [] ;
        foreach ($column_list as $key=>$value){
            $sub_column[] = $value['id'] ;
        }        
        $sub_column_arr = ColumnService::findColumnList(null, 1,$sub_column) ;
        foreach ($column_list as $key=>$value){
            $column_select[$value['id']] = $value['name'] ;
            foreach ($sub_column_arr['list'] as $sub_value){
                if($value['id']==$sub_value['pid']){
                    $column_select[$sub_value['id']] = "--".$sub_value['name'] ;
                }
            }
        }              
        return $column_select ;
    }

    public function getTypeList(){
        $type_list = [
            ColumnService::RIGHT_TYPE=>"右侧栏目",
            ColumnService::SUB_TYPE=>"左侧栏目子菜单",
        ] ;
        return $type_list ;
    }
    
    public function addColumn(){
        if(empty($this->id)){
            $column = new Column() ;
            $msg_type = "增加" ;
        }else{
            $column = ColumnService::findColumnById($this->id) ;
            $msg_type = "修改" ;
        }
        $column->pid = $this->pid ;
        $column->tag = $this->tag ;
        $column->name = $this->name ;
        $column->order = $this->order ;
        $column->status = $this->status ;
        $column->addtime = time() ; 
        $column->addip = Yii::$app->getRequest()->userIP ;
        $column->params = $this->params ;
        if(empty($this->pid)){
            $column->type = "" ;
        }else{
            $column->type = $this->type ;
        }
        $add_rs = $column->save() ;
        
        if($add_rs==true){
            return ["status"=>true,"msg"=>$msg_type."栏目成功"] ;
        }else{
            return ["status"=>false,"msg"=>$msg_type."栏目失败-".  current($column->getFirstErrors())] ;
        }
    }
    
}
