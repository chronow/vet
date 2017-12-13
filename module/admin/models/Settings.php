<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $name
 * @property string $k
 * @property string $v
 * @property string $type
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'k', 'v'], 'string'],
            [['type'], 'required'],
            [['type'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Параметр',
            'k' => 'Ключ',
            'v' => 'Значение',
            'type' => 'Тип',
        ];
    }
}
