<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "reports_medicines".
 *
 * @property integer $id
 * @property integer $id_priem
 * @property integer $id_reports
 * @property integer $id_medicines
 * @property integer $all_count
 * @property double $price
 * @property double $all_price
 * @property integer $date_time
 */
class ReportsMedicines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports_medicines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_priem', 'id_reports', 'id_medicines', 'all_count', 'price', 'all_price', 'date_time'], 'required'],
            [['id_priem', 'id_reports', 'id_medicines', 'all_count', 'date_time'], 'integer'],
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
            'id_medicines' => 'Медикамент',
            'all_count' => 'Кол-во',
            'price' => 'Цена за ед.',
            'all_price' => 'Полная стоимость',
            'date_time' => 'Дата',
        ];
    }
}
