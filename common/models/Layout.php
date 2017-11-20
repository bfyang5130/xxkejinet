<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "layout".
 *
 * @property int $layout_id 布局id
 * @property string $layout_name 布局名称
 * @property int $layout_staus 布局状态
 * @property int $layout_type 布局类型
 * @property string $layout_description 布局描述
 * @property string $layout_m_pic 小图
 * @property string $layout_b_pic
 * @property string $layout_source 文件源地址
 * @property int $module_num 模块数量
 * @property int $layout_author_id 布局作者
 * @property string $layout_price 布局价格
 * @property string $v_time 初审时间
 * @property string $r_time 复审时间
 * @property string $add_time  添加时间
 */
class Layout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'layout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['layout_name', 'layout_source'], 'required'],
            [['layout_staus', 'layout_type', 'module_num', 'layout_author_id'], 'integer'],
            [['layout_description'], 'string'],
            [['layout_price'], 'number'],
            [['v_time', 'r_time', 'add_time'], 'safe'],
            [['layout_name'], 'string', 'max' => 200],
            [['layout_m_pic', 'layout_b_pic', 'layout_source'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'layout_id' => 'Layout ID',
            'layout_name' => 'Layout Name',
            'layout_staus' => 'Layout Staus',
            'layout_type' => 'Layout Type',
            'layout_description' => 'Layout Description',
            'layout_m_pic' => 'Layout M Pic',
            'layout_b_pic' => 'Layout B Pic',
            'layout_source' => 'Layout Source',
            'module_num' => 'Module Num',
            'layout_author_id' => 'Layout Author ID',
            'layout_price' => 'Layout Price',
            'v_time' => 'V Time',
            'r_time' => 'R Time',
            'add_time' => 'Add Time',
        ];
    }
}
