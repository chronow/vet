<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "reports_services".
 *
 * @property integer $id
 * @property integer $id_priem
 * @property integer $id_reports
 * @property integer $id_services
 * @property string $title
 * @property integer $all_count
 * @property double $price
 * @property double $all_price
 * @property integer $date_time
 */
class ReportsServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_priem', 'id_reports', 'id_services', 'title', 'all_count', 'price', 'all_price', 'date_time'], 'required'],
            [['id_priem', 'id_reports', 'id_services', 'all_count', 'date_time'], 'integer'],
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
            'id_services' => 'Услуга',
            'title' => 'Название',
            'all_count' => 'Кол-во',
            'price' => 'Цена за ед.',
            'all_price' => 'Полная стоимость',
            'date_time' => 'Дата',
        ];
    }
}
