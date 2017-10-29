<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_exist_layout".
 *
 * @property int $id 主键ID
 * @property int $user_id 用户id
 * @property int $layout_id 布局ID
 * @property int $layout_type 布局类型
 * @property int $layout_version 布局版本
 * @property int $is_enbale 是否启用
 * @property string $last_time 有效期
 * @property string $create_time 添加时间
 */
class UserExistLayout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_exist_layout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'layout_id'], 'required'],
            [['user_id', 'layout_id', 'layout_type', 'layout_version', 'is_enbale'], 'integer'],
            [['last_time', 'create_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'layout_id' => 'Layout ID',
            'layout_type' => 'Layout Type',
            'layout_version' => 'Layout Version',
            'is_enbale' => 'Is Enbale',
            'last_time' => 'Last Time',
            'create_time' => 'Create Time',
        ];
    }
}
