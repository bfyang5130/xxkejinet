<?php

namespace backend\models\form;

use yii\base\Model;
use common\models\Layout;
use backend\services\BPlotService;
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
            [['layout_description'], 'string', 'min' => 10, 'message' => '布局简介不能少于10个字符'],
            [['layout_description'], 'string', 'max' => 500, 'message' => '布局简介最多为500个字符'],
            [['layout_name'], 'string', 'min' => 5],
            [['layout_name'], 'string', 'max' => 200],
            [['layout_type'], 'in', 'range' => [0, 1, 2, 3, 4], 'message' => '错误的布局类型'],
            [['module_num'], 'integer', 'min' => '1', 'message' => '布局最少拥有1个模块'],
            [['module_num'], 'integer', 'max' => '2', 'message' => '布局最多拥有20个模块'],
            [['layout_price'], 'match', 'pattern' => '/(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/', 'message' => '输入资金格式不正确'],
            [['layout_ｂ_pic'], 'file', 'extensions' => 'jpg, png,jpeg,gif', 'mimeTypes' => 'image/jpeg, image/png,image/gif,', 'message' => '只允许上传jpg/png/gif格式图片'],
            [['layout_source'], 'file', 'extensions' => 'zip', 'maxSize' => 10 * 1024 * 1024, 'message' => '只允许上传zip格式d压缩包'],
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
        return BPlotService::getLayoutType();
    }

    public function save() {
        if (empty($this->layout_id)) {
            $layout = new Layout();
            $msg_type = "增加";
        } else {
            $layout = Layout::findOne($this->layout_id);
            $msg_type = "修改";
        }
        $layout->setAttributes($this->getAttributes());
        $layout->layout_staus = 0;
        $layout->layout_m_pic = $this->layout_ｂ_pic;
        $layout->layout_b_pic = $layout->layout_m_pic;
        $layout->layout_author_id = \Yii::$app->admin->identity->user_id;
        $layout->v_time = $layout->r_time = $layout->add_time = date('Y-m-d H:i:s');
        $add_rs = $layout->save();

        if ($add_rs == true) {
            return ["status" => true, "msg" => $msg_type . "布局设计成功"];
        } else {
            return ["status" => false, "msg" => $msg_type . "布局设计栏目失败-" . current($layout->getFirstErrors())];
        }
    }

}
