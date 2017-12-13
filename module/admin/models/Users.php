<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $pass
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
    public $password2;
    
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
            [['username', 'password', 'password2', 'name'], 'required'],
            [['email', 'phone', 'status', 'name', 'type', 'ip'], 'string'],
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
            'username' => 'Логин пользователя',
            'password' => 'Пароль',
            'password2' => 'Повтор пароля',
            'email' => 'Email',
            'phone' => 'Телефон',
            'status' => 'Статус',
            'name' => 'Имя пользователя',
            'type' => 'Тип учётки',
            'balance' => 'Баланс',
            'date' => 'Дата',
            'ip' => 'Ip',
        ];
    }
}
