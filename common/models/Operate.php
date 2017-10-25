<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Operate".
 *
 * @property string $id
 * @property string $operate_name
 * @property string $operate_page
 * @property string $operate_time
 * @property string $operate_ip
 */
class Operate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Operate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operate_time'], 'safe'],
            [['operate_name', 'operate_ip'], 'string', 'max' => 255],
            [['operate_page'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operate_name' => 'Operate Name',
            'operate_page' => 'Operate Page',
            'operate_time' => 'Operate Time',
            'operate_ip' => 'Operate Ip',
        ];
    }
}
