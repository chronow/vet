<?php

namespace app\module\admin\models;

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
 * @property string $phone
 * @property string $status
 * @property string $name
 * @property string $type
 * @property double $balance
 * @property integer $date
 * @property string $ip
 * @property string $note
 */
class Clients extends \yii\db\ActiveRecord
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
            [['username', 'password', 'authKey', 'accessToken', 'email', 'phone', 'status', 'name', 'type', 'ip', 'note', 'address'], 'string'],
            [['phone', 'name'], 'required'],
            [['email'], 'email'],
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
            'username' => 'Логин клиента',
            'password' => 'Пароль',
            'password2' => 'Повтор пароля',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'status' => 'Статус',
            'name' => 'Клиент ФИО',
            'type' => 'Тип учётки',
            'balance' => 'Баланс',
            'date' => 'Дата',
            'ip' => 'Ip',
            'note' => 'Примечания',
        ];
    }
}
