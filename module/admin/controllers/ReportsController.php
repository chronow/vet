<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\Reports;
use app\module\admin\models\ReportsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use app\module\admin\models\Medicines;
use app\module\admin\models\ReportsMedicines;

use app\module\admin\models\Analyzes;
use app\module\admin\models\ReportsAnalyzes;

use app\module\admin\models\Services;
use app\module\admin\models\ReportsServices;

/**
 * ReportsController implements the CRUD actions for Reports model.
 */
class ReportsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Reports models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reports model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reports();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->date=date("Y-m-d");
            $model->time=date("H:i");
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        global $listMedicines, $htmlMed, $listAnalyzes, $htmlAna, $listServices, $htmlSer;
        
        $model = $this->findModel($id);
        
        //$this->reportsForm($id);
        $dataReports = $model->reportsForm;
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->date=date("Y-m-d");
            $model->time=date("H:i");
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'reportsInfo' => $model,
                'listMedicines' => $dataReports['listMedicines'],
                'medReload' => $dataReports['htmlMed'],
                'listAnalyzes' => $dataReports['listAnalyzes'],
                'anaReload' => $dataReports['htmlAna'],
                'listServices' => $dataReports['listServices'],
                'serReload' => $dataReports['htmlSer'],
            ]);
        }
    }
    
    /**
     * Формы отчёта по Медикаментам, Анализам, Услугам
     * УДАЛИТЬ
    public function reportsForm($id)
    {   
        global $listMedicines, $htmlMed, $listAnalyzes, $htmlAna, $listServices, $htmlSer;
        
        $model = $this->findModel($id);
        
        if(!$model || !$id)return false;
        
        
        $listMedicines = Medicines::find()->select(['title as label', 'title as value', 'id as id'])->asArray()->all();
        
        $masMed = ReportsMedicines::find()->where(['id_priem' => $model->id_priem])->asArray()->all();
        $htmlMed = $this->htmlTableMed($masMed);
        
        $listAnalyzes = Analyzes::find()->select(['title as label', 'title as value', 'id as id'])->asArray()->all();
        
        $masAna = ReportsAnalyzes::find()->where(['id_priem' => $model->id_priem])->asArray()->all();
        $htmlAna = $this->htmlTableAna($masAna);
        
        $listServices = Services::find()->select(['title as label', 'title as value', 'id as id'])->asArray()->all();
        
        $masSer = ReportsServices::find()->where(['id_priem' => $model->id_priem])->asArray()->all();
        $htmlSer = $this->htmlTableSer($masSer);
        
    }*/

    /**
     * Deletes an existing Reports model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reports::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Запись отчёта по медикаменту через Pjax
     * */
    public function actionPjaxMedicinesCreate($id){
        
        $Reports = $this->findModel($id);
        
        $mas = Yii::$app->request->post('Reports');
        $medid = (int)$mas['medId'];
        $all_count = (int)$mas['medCount'];
        
        if(Yii::$app->request->isAjax && intval($medid)>0 && intval($all_count)>0){
            
            //Получаем выбранный медикамент
            $medicines = Medicines::findOne($medid);
            
            //Просчитываем общую стоимость
            $all_price = $medicines->price_retail * $all_count;
            
            //СОздаем отчёт по данному медикаменту(запись в бд reports_medicines)
            $ReportsMedicines = new ReportsMedicines();
            $ReportsMedicines->id_priem = $Reports->id_priem;
            $ReportsMedicines->id_reports = $Reports->id;
            $ReportsMedicines->id_medicines = $medid;
            $ReportsMedicines->title = $medicines->title;
            $ReportsMedicines->all_count = $all_count;
            $ReportsMedicines->price = $medicines->price_retail;
            $ReportsMedicines->all_price = $all_price;
            $ReportsMedicines->date_time = time();
            $ReportsMedicines->save();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $allMedicines = ReportsMedicines::find()->where(['id_priem' => $Reports->id_priem])->asArray()->all();
            
            //Формируем таблицу вывода
            $html = '<table class="table table-striped table-bordered detail-view">';
            $html .= '<tr><th>Медикамент</th><th>Кол-во</th><th>Стоимость</th></tr>';
            if($allMedicines)foreach($allMedicines as $item){
                $html .= '<tr><td>'.$item['title'].'</td><td>'.$item['all_count'].'</td><td>'.$item['all_price'].'</td></tr>';
            }
            $html .= '</table>';
            
            return $this->render('update', [
                'model' => $Reports,
                'medReload' => $html,
            ]);
        }
    }
    
    
    
    
    
    /**
     * Запись отчёта по медикаменту через Ajax
     * */
    public function actionAjaxMedicinesCreate(){
        
        $mas = Yii::$app->request->post();
        
        $id = (int)$mas['idRep'];
        
        $Reports = $this->findModel($id);
        
        $medid = (int)$mas['medId'];
        $all_count = (int)$mas['medCount'];
        
        if(Yii::$app->request->isAjax && intval($medid)>0 && intval($all_count)>0){
            
            //Получаем выбранный медикамент
            $medicines = Medicines::findOne($medid);
            
            //Просчитываем общую стоимость
            $all_price = $medicines->price_retail * $all_count;
            
            //СОздаем отчёт по данному медикаменту(запись в бд reports_medicines)
            $ReportsMedicines = new ReportsMedicines();
            $ReportsMedicines->id_priem = $Reports->id_priem;
            $ReportsMedicines->id_reports = $Reports->id;
            $ReportsMedicines->id_medicines = $medid;
            $ReportsMedicines->title = $medicines->title;
            $ReportsMedicines->all_count = $all_count;
            $ReportsMedicines->price = $medicines->price_retail;
            $ReportsMedicines->all_price = $all_price;
            $ReportsMedicines->date_time = time();
            $ReportsMedicines->save();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $tableMas = ReportsMedicines::find()->where(['id_priem' => $Reports->id_priem])->asArray()->all();
            
            $data['html'] = $Reports->getHtmlTableType($tableMas, 'Med');
            $data['summ'] = $Reports->getAllSumm($Reports->id_priem);
            $json = json_encode($data);
            return $json;
        }
        return false;
    }
    /**
     * Удаление отчёта по медикаменту через Ajax
     * */
    public function actionAjaxMedicinesDelete(){
        $id = (int)Yii::$app->request->post()['id'];
        
        if(Yii::$app->request->isAjax && intval($id)>0){
            $ReportsMedicines = ReportsMedicines::findOne($id);
            
            $ReportsMedicines->delete();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $tableMas = ReportsMedicines::find()->where(['id_priem' => $ReportsMedicines->id_priem])->asArray()->all();
            
            $Reports = new Reports();
            $data['html'] = $Reports->getHtmlTableType($tableMas, 'Med');
            $data['summ'] = $Reports->getAllSumm($ReportsMedicines->id_priem);
            $json = json_encode($data);
            return $json;
        }
        return false;
    }
    
    
    
    
    
    
    /**
     * Запись отчёта по медикаменту через Ajax
     * */
    public function actionAjaxAnalyzesCreate(){
        
        $mas = Yii::$app->request->post();
        
        $id = (int)$mas['idRep'];
        $Reports = $this->findModel($id);
        
        $anaid = (int)$mas['anaId'];
        $all_count = (int)$mas['anaCount'];
        
        if(Yii::$app->request->isAjax && intval($anaid)>0 && intval($all_count)>0){
            
            //Получаем выбранный медикамент
            $analyzes = Analyzes::findOne($anaid);
            
            //Просчитываем общую стоимость
            $all_price = $analyzes->price * $all_count;
            
            //СОздаем отчёт по данному медикаменту(запись в бд reports_analyzes)
            $ReportsAnalyzes = new ReportsAnalyzes();
            $ReportsAnalyzes->id_priem = $Reports->id_priem;
            $ReportsAnalyzes->id_reports = $Reports->id;
            $ReportsAnalyzes->id_analyzes = $anaid;
            $ReportsAnalyzes->title = $analyzes->title;
            $ReportsAnalyzes->all_count = $all_count;
            $ReportsAnalyzes->price = $analyzes->price;
            $ReportsAnalyzes->all_price = $all_price;
            $ReportsAnalyzes->date_time = time();
            $ReportsAnalyzes->save();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $tableMas = ReportsAnalyzes::find()->where(['id_priem' => $Reports->id_priem])->asArray()->all();
            
            $data['html'] = $Reports->getHtmlTableType($tableMas, 'Ana');
            $data['summ'] = $Reports->getAllSumm($Reports->id_priem);
            $json = json_encode($data);
            return $json;
        }
        return false;
    }
    /**
     * Удаление отчёта по медикаменту через Ajax
     * */
    public function actionAjaxAnalyzesDelete(){
        $id = (int)Yii::$app->request->post()['id'];
        
        if(Yii::$app->request->isAjax && intval($id)>0){
            $ReportsAnalyzes = ReportsAnalyzes::findOne($id);
            
            $ReportsAnalyzes->delete();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $tableMas = ReportsAnalyzes::find()->where(['id_priem' => $ReportsAnalyzes->id_priem])->asArray()->all();
            
            $Reports = new Reports();
            $data['html'] = $Reports->getHtmlTableType($tableMas, 'Ana');
            $data['summ'] = $Reports->getAllSumm($ReportsAnalyzes->id_priem);
            $json = json_encode($data);
            return $json;
        }
        return false;
    }
    
    
    
    
    
    /**
     * Запись отчёта по медикаменту через Ajax
     * */
    public function actionAjaxServicesCreate(){
        
        $mas = Yii::$app->request->post();
        
        $id = (int)$mas['idRep'];
        $Reports = $this->findModel($id);
        
        $serid = (int)$mas['serId'];
        $all_count = (int)$mas['serCount'];
        
        if(Yii::$app->request->isAjax && intval($serid)>0 && intval($all_count)>0){
            
            //Получаем выбранный медикамент
            $services = Services::findOne($serid);
            
            //Просчитываем общую стоимость
            $all_price = $services->price * $all_count;
            
            //СОздаем отчёт по данному медикаменту(запись в бд reports_services)
            $ReportsServices = new ReportsServices();
            $ReportsServices->id_priem = $Reports->id_priem;
            $ReportsServices->id_reports = $Reports->id;
            $ReportsServices->id_services = $serid;
            $ReportsServices->title = $services->title;
            $ReportsServices->all_count = $all_count;
            $ReportsServices->price = $services->price;
            $ReportsServices->all_price = $all_price;
            $ReportsServices->date_time = time();
            $ReportsServices->save();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $tableMas = ReportsServices::find()->where(['id_priem' => $Reports->id_priem])->asArray()->all();
            
            $data['html'] = $Reports->getHtmlTableType($tableMas, 'Ser');
            $data['summ'] = $Reports->getAllSumm($Reports->id_priem);
            $json = json_encode($data);
            return $json;
        }
        return false;
    }
    /**
     * Удаление отчёта по медикаменту через Ajax
     * */
    public function actionAjaxServicesDelete(){
        $id = (int)Yii::$app->request->post()['id'];
        
        if(Yii::$app->request->isAjax && intval($id)>0){
            $ReportsServices = ReportsServices::findOne($id);
            
            $ReportsServices->delete();
            
            //Получаем все отчёты данного приема по медикаментам для общего вывода
            $tableMas = ReportsServices::find()->where(['id_priem' => $ReportsServices->id_priem])->asArray()->all();
            
            $Reports = new Reports();
            $data['html'] = $Reports->getHtmlTableType($tableMas, 'Ser');
            $data['summ'] = $Reports->getAllSumm($ReportsServices->id_priem);
            $json = json_encode($data);
            return $json;
        }
        return false;
    }
}
