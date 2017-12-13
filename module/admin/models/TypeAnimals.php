<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "type_animals".
 *
 * @property integer $id
 * @property string $name
 */
class TypeAnimals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_animals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название вида',
        ];
    }
}
