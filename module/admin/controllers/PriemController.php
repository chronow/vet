<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\Animals;
use app\module\admin\models\Priem;
use app\module\admin\models\PriemSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;

use app\module\admin\models\Reports;

/**
 * PriemController implements the CRUD actions for Priem model.
 */
class PriemController extends Controller
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
                    'delete' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Priem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->setSort(['defaultOrder' => ['id'=>SORT_DESC]]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Priem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        
        $ReportsMedicines = $model->ReportsMedicinesFunc;
        $ReportsAnalyzes = $model->ReportsAnalyzesFunc;
        $ReportsServices = $model->ReportsServicesFunc;
        
        return $this->render('view', [
            'model' => $model,
            'reports_medicines' => $ReportsMedicines,
            'reports_analyzes' => $ReportsAnalyzes,
            'reports_services' => $ReportsServices,
        ]);
    }

    /**
     * Creates a new Priem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Priem();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->id_type_animals = $model->TypeAnimalsFunc->id;
            
            $model->summ=0;
            
            $model->save();
            
            $Reports = new Reports();
            $Reports->id_priem = $model->id;
            $Reports->date = date("Y-m-d");
            $Reports->time = date("H:i");
            $Reports->save();
            
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Priem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        $model = $this->findModel($id);
        
        $Reports = new Reports();
        
        //ПРоверяем существует ли отчёт по данному приёму, если нет то создаем
        //$itemExist = Yii::$app->db->createCommand("SELECT * FROM reports WHERE id_priem = '".$model->id."' ")->queryOne();
        $ReportsInfo = $Reports::find()
                              ->where('id_priem=:id',[':id' => $id])
                              ->one();
        if(!$ReportsInfo){
            $Reports->id_priem = $id;
            $Reports->date = date("Y-m-d");
            $Reports->time = date("H:i");
            $Reports->save();
        }
        
        $dataReports = $Reports->getReportsForm($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'reportsInfo' => $ReportsInfo,
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
     * Deletes an existing Priem model.
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
     * Finds the Priem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Priem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Priem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Порода животного
     * */
    public function actionAjaxBreed(){
        if(Yii::$app->request->isAjax){
            $id = (int)Yii::$app->request->post('id');
            
            $option = '';
            $animals = Animals::find()
                              ->where('id_type_animals=:id',[':id' => $id])
                              ->orderBy('id')
                              ->all();

            if($animals)foreach ($animals as $item){
                $option .= '<option value="' . $item->id . '">' . $item->breed . '</option>';
            }

        }
        return $option;
    }
    
    
    
    /**
     * Порода животного
     * */
    public function actionAjaxPriem(){
        
        if(Yii::$app->request->isAjax){
            $id = (int)Yii::$app->request->post('id');
            
            /*$search = Priem::find()
                              ->where('id_users=:id',[':id' => $id])
                              ->orderBy('id')
                              ->one();*/
            
            $search = Priem::findOne($id);
            
            if($search){
                return $this->renderAjax('view_from_ajax', [
                    'model' => $search,
                ]);
            }else{
                return '
                <h3 class="pull-left mr_t0 text-muted">Бланк приёма #</h3>
                <div class="clearfix"></div>
                <div class="panel panel-warning">
                  <div class="panel-heading text-uppercase">
                    <span class="glyphicon glyphicon-exclamation-sign"></span> Не верный id номер бланка
                  </div>
                  <div class="panel-body">Проверьте корректность номера бланка в разделе Приём.</div>
                </div>';
            }

        }
        return false;
    }
}
