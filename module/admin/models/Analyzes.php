<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "analyzes".
 *
 * @property integer $id
 * @property string $title
 * @property double $baseprice
 * @property double $markup
 * @property string $type
 * @property double $price
 */
class Analyzes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analyzes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
            [['baseprice', 'markup', 'price'], 'number'],
            [['type'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'baseprice' => 'Базовая цена',
            'markup' => 'Наценка',
            'type' => 'Тип наценки',
            'price' => 'Цена Итоговая',
        ];
    }

    /**
     * @inheritdoc
     * @return AnalyzesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnalyzesQuery(get_called_class());
    }
}
