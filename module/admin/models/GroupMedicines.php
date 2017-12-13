<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "group_medicines".
 *
 * @property integer $id
 * @property string $name
 */
class GroupMedicines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_medicines';
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
            'name' => 'Название группы',
        ];
    }
}
