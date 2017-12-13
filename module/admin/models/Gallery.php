<?php

namespace app\module\admin\models;


use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property string $id
 * @property integer $id_project
 * @property string $img
 * @property string $title
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_project'], 'integer'],
            [['img_original', 'img_800x600', 'img_373x280', 'img_150x150', 'title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_project' => 'Относится к проекту',
            'img_original' => 'Изображение',
            'title' => 'Подпись',
        ];
    }
}
