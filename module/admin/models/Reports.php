<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property integer $id
 * @property integer $id_priem
 * @property string $date
 * @property string $time
 * @property string $note
 */
class Reports extends \yii\db\ActiveRecord
{   
    public $medTitle, $medId, $medCount, $anaTitle, $anaId, $anaCount, $serTitle, $serId, $serCount;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_priem', 'date', 'time'], 'required'],
            [['id_priem', 'medCount', 'medId', 'anaCount', 'anaId', 'serCount', 'serId'], 'integer'],
            [['date'], 'safe'],
            [['time', 'note', 'medTitle', 'anaTitle', 'serTitle'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_priem' => '№ бланка приема',
            'date' => 'Дата отчёта',
            'time' => 'Время отчёта',
            'note' => 'Примечания к отчёту',
        ];
    }

    /**
     * @inheritdoc
     * @return ReportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReportsQuery(get_called_class());
    }
    
    
    /**
     * Формы отчёта по Медикаментам, Анализам, Услугам
     * для вывода на экран     
     * */
    public function getReportsForm($id_priem=0)
    {   
        if($id_priem==0)$id_priem=$this->id_priem;
        
        /** Формы отчёта **/
        $data['listMedicines'] = Medicines::find()->select(['title as label', 'title as value', 'id as id'])->asArray()->all();
        
        $masMed = ReportsMedicines::find()->where(['id_priem' => $id_priem])->asArray()->all();
        $data['htmlMed'] = $this->getHtmlTableType($masMed, 'Med');
        
        $data['listAnalyzes'] = Analyzes::find()->select(['title as label', 'title as value', 'id as id'])->asArray()->all();
        
        $masAna = ReportsAnalyzes::find()->where(['id_priem' => $id_priem])->asArray()->all();
        $data['htmlAna'] = $this->getHtmlTableType($masAna, 'Ana');
        
        $data['listServices'] = Services::find()->select(['title as label', 'title as value', 'id as id'])->asArray()->all();
        
        $masSer = ReportsServices::find()->where(['id_priem' => $id_priem])->asArray()->all();
        $data['htmlSer'] = $this->getHtmlTableType($masSer, 'Ser');
        /** END Формы отчёта **/
        
        return $data;
    }
    
    
    /**
     * Формируем HTML таблицу вывода в зависимости от type без удаления
     * */
    public function getHtmlTableType2($array, $type){
        $summ=0;
        $html = '<table class="table table-striped table-bordered detail-view">';
        $html .= '<tr><th>Название</th><th class="text-center" style="width:70px;">Кол-во</th><th style="width:140px;">Стоимость</th></tr>';
        if($array)foreach($array as $item){
            $html .= '<tr><td>'.$item['title'].'</td><td class="text-center">x '.$item['all_count'].'</td><td>'.$item['all_price'].'</td></tr>';
            $summ += $item['all_price'];
        }
        $html .= '<tr><th></th><th></th><th>Всего: '.$summ.' руб.</th></tr>';
        $html .= '</table>';
        return $html;
    }
    /**
     * Формируем HTML таблицу вывода в зависимости от type
     * */
    public function getHtmlTableType($array, $type){
        $summ=0;
        $html = '<table class="table table-striped table-bordered detail-view">';
        $html .= '<tr><th>Название</th><th class="text-center" style="width:70px;">Кол-во</th><th style="width:140px;">Стоимость</th><th style="width:42px;"></th></tr>';
        if($array)foreach($array as $item){
            $a = '<div class="btn btn-danger btn-xs" onclick="del'.$type.'('.$item['id'].')"><span class="glyphicon glyphicon-remove"></span></div>';
            $html .= '<tr><td>'.$item['title'].'</td><td class="text-center">x '.$item['all_count'].'</td><td>'.$item['all_price'].'</td><td>'.$a.'</td></tr>';
            $summ += $item['all_price'];
        }
        $html .= '<tr><th></th><th></th><th>Всего: '.$summ.' руб.</th><th></th></tr>';
        $html .= '</table>';
        return $html;
    }
    
    /**
     * Получение Итоговой суммы со всех отчётов
     * */         
    public function getAllSumm($id_priem){
        if(!$id_priem || $id_priem==0)return false;
        $summMedicines = ReportsMedicines::find()->where(['id_priem' => $id_priem])->sum('[[all_price]]');
        $summAnalyzes = ReportsAnalyzes::find()->where(['id_priem' => $id_priem])->sum('[[all_price]]');
        $summServices = ReportsServices::find()->where(['id_priem' => $id_priem])->sum('[[all_price]]');
        $allSumm = $summMedicines+$summAnalyzes+$summServices;
        
        $Priem = Priem::findOne($id_priem);
        $Priem->summ = $allSumm;
        $Priem->update();
        
        return $allSumm;
    }            
}
