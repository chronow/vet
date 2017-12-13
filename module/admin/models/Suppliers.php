<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "suppliers".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $fio
 * @property string $about
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'email', 'site', 'fio', 'about'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'Email',
            'site' => 'Сайт',
            'fio' => 'Контактное лицо',
            'about' => 'Подробнее',
        ];
    }
    
}
