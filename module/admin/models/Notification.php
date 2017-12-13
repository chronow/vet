<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property string $id
 * @property string $name
 * @property string $lang
 * @property string $subject
 * @property string $template
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lang', 'subject', 'template'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lang' => 'Lang',
            'subject' => 'Subject',
            'template' => 'Template',
        ];
    }
}
