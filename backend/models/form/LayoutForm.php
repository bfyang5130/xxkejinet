<?php

namespace backend\models\form;

use yii\base\Model;
use app\models\Column;
use common\services\ColumnService;
use Yii;

/**
 *  栏目表单
 */
class LayoutForm extends Model {

    public $layout_id;
    public $layout_name;
    public $layout_type;
    public $layout_description;
    public $layout_ｂ_pic;
    public $layout_source;
    public $module_num;
    public $layout_price;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pid', 'status', 'addtime', 'order'], 'integer'],
            [['layout_description'], 'string', 'min' => 100, 'message' => '布局简介不能少于100个字符'],
            [['layout_description'], 'string', 'max' => 500, 'message' => '布局简介最多为500个字符'],
            [['layout_name'], 'string', 'min' => 5],
            [['layout_name'], 'string', 'max' => 200],
            [['layout_type'], 'in', 'range' => [0, 1, 2, 3, 4], 'message' => '错误的布局类型'],
            [['module_num'], 'integer', 'min' => '1', 'message' => '布局最少拥有1个模块'],
            [['module_num'], 'integer', 'max' => '2', 'message' => '布局最多拥有20个模块'],
            [['layout_price'], 'match', 'pattern' => '/(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/', 'message' => '输入资金格式不正确'],
            
            ['layout_id', 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'layout_id' => '布局ID',
            'layout_name' => '布局名称',
            'layout_type' => '布局类型',
            'module_num' => '模块数量',
            'layout_description' => '布局简述',
            'layout_ｂ_pic' => '形象图',
            'layout_source' => '源码',
            'layout_price' => '定价',
        ];
    }

    public function getLayoutType() {
        return [
            '0' => "首页",
            '1' => '类别',
            '2' => "列表",
            '3' => '文章',
            '4' => '专题',
                ];
    }

    public function addColumn() {
        if (empty($this->id)) {
            $column = new Column();
            $msg_type = "增加";
        } else {
            $column = ColumnService::findColumnById($this->id);
            $msg_type = "修改";
        }
        $column->pid = $this->pid;
        $column->tag = $this->tag;
        $column->name = $this->name;
        $column->order = $this->order;
        $column->status = $this->status;
        $column->addtime = time();
        $column->addip = Yii::$app->getRequest()->userIP;
        $column->params = $this->params;
        if (empty($this->pid)) {
            $column->type = "";
        } else {
            $column->type = $this->type;
        }
        $add_rs = $column->save();

        if ($add_rs == true) {
            return ["status" => true, "msg" => $msg_type . "栏目成功"];
        } else {
            return ["status" => false, "msg" => $msg_type . "栏目失败-" . current($column->getFirstErrors())];
        }
    }

}
