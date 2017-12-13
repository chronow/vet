<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "pets".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_users
 * @property integer $id_animals
 * @property integer $id_type_animals
 * @property integer $note
 */
class Pets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_users', 'id_animals', 'id_type_animals'], 'required'],
            [['name', 'note'], 'string'],
            [['id_users', 'id_animals', 'id_type_animals'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Кличка',
            'id_users' => 'Владелец',
            'id_animals' => 'Порода питомца',
            'id_type_animals' => 'Вид питомца',
            'note' => 'Примечания',
            'fullName' => 'ФИО владельца',
        ];
    }
    
    /**
     * Владелец ФИО
     * */
    public function getFullName() {
        return $this->nameClientsFunc->name;
    }
    
    /**
     * Владелец
     * */
    public function getNameClientsFunc()
    {
        return $this->hasOne(Clients::className(), ['id' => 'id_users']);
    }
    
    /**
     * Вид животного
     * */
    public function getTypeAnimalsFunc()
    {
        return $this->hasOne(TypeAnimals::className(), ['id' => 'id_type_animals']);
    }
    
    /**
     * Порода животного
     * */
    public function getBreedAnimalsFunc()
    {
        return $this->hasOne(Animals::className(), ['id' => 'id_animals']);
    }
}
