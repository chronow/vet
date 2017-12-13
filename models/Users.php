<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $email
 * @property string $status
 * @property string $name
 * @property string $type
 * @property double $balance
 * @property integer $date
 * @property string $ip
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken', 'email', 'status', 'name', 'type', 'ip'], 'string'],
            [['authKey'], 'required'],
            [['balance'], 'number'],
            [['date'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'email' => 'Email',
            'status' => 'Status',
            'name' => 'Name',
            'type' => 'Type',
            'balance' => 'Balance',
            'date' => 'Date',
            'ip' => 'Ip',
        ];
    }
}
