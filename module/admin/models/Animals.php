<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "animals".
 *
 * @property integer $id
 * @property integer $id_type_animals
 * @property integer $breed
 */
class Animals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_type_animals', 'breed'], 'required'],
            [['breed'], 'string'],
            [['id_type_animals'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_type_animals' => 'Вид животного',
            'breed' => 'Порода',
        ];
    }
    
    public function getTypeAnimals()
    {
        return $this->hasOne(TypeAnimals::className(), ['id' => 'id_type_animals']);
    }
    
}
