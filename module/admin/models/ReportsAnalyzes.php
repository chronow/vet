<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "reports_analyzes".
 *
 * @property integer $id
 * @property integer $id_priem
 * @property integer $id_reports
 * @property integer $id_analyzes
 * @property string $title
 * @property integer $all_count
 * @property double $price
 * @property double $all_price
 * @property integer $date_time
 */
class ReportsAnalyzes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports_analyzes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_priem', 'id_reports', 'id_analyzes', 'title', 'all_count', 'price', 'all_price', 'date_time'], 'required'],
            [['id_priem', 'id_reports', 'id_analyzes', 'all_count', 'date_time'], 'integer'],
            [['title'], 'string'],
            [['price', 'all_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_priem' => 'Карточка приема',
            'id_reports' => 'Id отчёта',
            'id_analyzes' => 'Анализ',
            'title' => 'Название',
            'all_count' => 'Кол-во',
            'price' => 'Цена за ед.',
            'all_price' => 'Полная стоимость',
            'date_time' => 'Дата',
        ];
    }
}
