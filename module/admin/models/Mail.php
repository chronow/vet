<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "mail".
 *
 * @property string $id
 * @property string $email
 * @property string $title
 * @property string $text
 * @property integer $time
 * @property string $status
 */
class Mail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'title', 'text'], 'string'],
            [['time'], 'integer'],
            [['status'], 'required'],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email получателя',
            'title' => 'Заголовок',
            'text' => 'Текст сообщения',
            'time' => 'Время создания',
            'status' => 'Статус',
        ];
    }
}
