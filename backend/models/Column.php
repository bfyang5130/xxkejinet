<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "au_module".
 *
 * @property integer $id
 * @property string $name
 * @property string $tag
 * @property integer $pid
 * @property integer $order
 * @property integer $status
 * @property integer $addtime
 * @property string $addip
 * @property string $params
 * @property string $type
 */
class Column extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'column';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'status', 'addtime','order'], 'integer'],
            [['name', 'tag'], 'string', 'max' => 100],
            [['addip'], 'string', 'max' => 50],
            [['params','type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
}
