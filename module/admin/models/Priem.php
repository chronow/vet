<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "priem".
 *
 * @property integer $id
 * @property string $date
 * @property string $time
 * @property string $sostoyanie
 * @property string $anamnez
 * @property string $diagnoz
 * @property string $naznachenie
 * @property double $summ
 *
 * @property Animals $idAnimals
 */
class Priem extends \yii\db\ActiveRecord
{   public $medTitle, $medId, $medCount, $anaTitle, $anaId, $anaCount, $serTitle, $serId, $serCount;
    public $animalsName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['time', 'sostoyanie', 'anamnez', 'diagnoz', 'naznachenie', 'medTitle', 'anaTitle', 'serTitle'], 'string'],
            [['id_users', 'id_pets', 'medCount', 'medId', 'anaCount', 'anaId', 'serCount', 'serId', 'id_type_animals'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата приема',
            'time' => 'Время',
            //'client' => 'Клиент ФИО',
            //'phone' => 'Телефон',
            'id_type_animals' => 'Вид животного',
            //'id_animals' => 'Порода',
            //'peet_name' => 'Кличка',
            'id_users' => 'Клиент ФИО',
            'id_pets' => 'Питомец',
            'sostoyanie' => 'Состояние',
            'anamnez' => 'Анамнез',
            'diagnoz' => 'Диагноз',
            'naznachenie' => 'Назначение',
            'summ' => 'Итоговая сумма',
            'fullName' => 'ФИО владельца',
            'animalsName' => 'Вид'
        ];
    }
    
    /**
     * Вид для Search
     **/
    public function getTypeAnimalsName()
    {
        return $this->typeAnimalsFunc->name;
    }
    /**
     * Владелец телефон
     * */
    public function getPhoneNumber() {
        return $this->nameClientsFunc->phone;
    }
    /**
     * Владелец ФИО
     * */
    public function getFullName() {
        return $this->nameClientsFunc->name;
    }
    
    
    
    /**
     * Клиент
     * */
    public function getNameClientsFunc()
    {
        return $this->hasOne(Clients::className(), ['id' => 'id_users']);
    }
    
    /**
     * Питомец
     * */
    public function getTypePetsFunc()
    {
        return $this->hasOne(Pets::className(), ['id' => 'id_pets']);
    }
    
    /**
     * Вид животного
     * */
    public function getTypeAnimalsFunc()
    {   
        $id_type_animals = $this->typePetsFunc->id_type_animals;
        return TypeAnimals::findOne($id_type_animals);
    }
    
    /**
     * Порода
     * */
    public function getBreedAnimalsFunc()
    {
        $id_animals = $this->typePetsFunc->id_animals;
        return Animals::findOne($id_animals);
    }
    
    
    
    /**
     * Получение записей отчёто приёма из таблицы
     * */
    public function getReportsMedicinesFunc()
    {   //return ReportsMedicines::findAll(['id_priem'=>$this->id]);
        $ReportsArray = ReportsMedicines::find()->where(['id_priem' => $this->id])->asArray()->all();
        if(count($ReportsArray)==0)return false;
        $Reports = new Reports();
        $html = $Reports->getHtmlTableType2($ReportsArray, 'Med');
        return $html;
    }
    /**
     * Получение записей отчёто приёма из таблицы
     * */
    public function getReportsAnalyzesFunc()
    {
        //return ReportsAnalyzes::findAll(['id_priem'=>$this->id]);
        $ReportsArray = ReportsAnalyzes::find()->where(['id_priem' => $this->id])->asArray()->all();
        if(count($ReportsArray)==0)return false;
        $Reports = new Reports();
        $html = $Reports->getHtmlTableType2($ReportsArray, 'Ana');
        return $html;
    }
    /**
     * Получение записей отчёто приёма из таблицы
     * */
    public function getReportsServicesFunc()
    {
        //return ReportsServices::findAll(['id_priem'=>$this->id]);
        $ReportsArray = ReportsServices::find()->where(['id_priem' => $this->id])->asArray()->all();
        if(count($ReportsArray)==0)return false;
        $Reports = new Reports();
        $html = $Reports->getHtmlTableType2($ReportsArray, 'Ser');
        return $html;
    }
}
