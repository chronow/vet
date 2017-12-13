<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "medicines".
 *
 * @property integer $id
 * @property string $title
 * @property integer $id_group_medicines
 * @property integer $id_suppliers
 * @property integer $in_stock
 * @property string $unit_type
 * @property double $received
 * @property double $price
 * @property double $all_price
 * @property double $price_retail
 * @property string $date_start
 * @property string $date_finished
 */
class Medicines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medicines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'id_group_medicines', 'id_suppliers', 'in_stock', 'unit_type', 'received', 'price', 'all_price', 'price_retail', 'date_start', 'date_finished'], 'required'],
            [['title'], 'string'],
            [['id_group_medicines', 'id_suppliers', 'in_stock'], 'integer'],
            [['received', 'price', 'all_price', 'price_retail'], 'number'],
            [['date_start', 'date_finished'], 'safe'],
            [['unit_type'], 'string', 'max' => 6],
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
            
            //'id_group_medicines' => 'Группа',
            'titleMedicines' => 'Группа',
            
            'id_suppliers' => 'Поставщик',
            'in_stock' => 'Наличие',
            'unit_type' => 'Ед. изм.',
            'received' => 'Кол-во на складе',
            'price' => 'Оптовая цена за ед.',
            'all_price' => 'Полная стоимость',
            'price_retail' => 'Розничная стоимость ед.',
            'date_start' => 'Дата выпуска',
            'date_finished' => 'Годен до',
        ];
    }
    
    public function getTitleMedicines()
    {
        return $this->dataGroupMedicines->name;
    }
    
    /**
     * Поставщики
     * **/
    public function getDataSuppliers()
    {
        return $this->hasOne(Suppliers::className(), ['id' => 'id_suppliers']);
    }
    
    public function getDataGroupMedicines()
    {
        return $this->hasOne(GroupMedicines::className(), ['id' => 'id_group_medicines']);
    }
}
