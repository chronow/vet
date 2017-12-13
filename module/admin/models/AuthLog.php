<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "auth_log".
 *
 * @property string $id
 * @property string $status
 * @property string $user
 * @property integer $time
 * @property string $ip
 */
class AuthLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'user', 'ip'], 'string'],
            [['time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'user' => 'User',
            'time' => 'Time',
            'ip' => 'Ip',
        ];
    }
}
