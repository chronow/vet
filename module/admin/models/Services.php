<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property integer $id_type_services
 * @property string $title
 * @property double $price
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_group_services', 'price'], 'required'],
            [['id_group_services'], 'integer'],
            [['title'], 'string'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_group_services' => 'Группа услуги',
            'title' => 'Название услуги',
            'price' => 'Стоимость услуги',
        ];
    }
    
    public function getDataGroupServices()
    {
        return $this->hasOne(GroupServices::className(), ['id' => 'id_group_services']);
    }
}
