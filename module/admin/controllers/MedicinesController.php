<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\Medicines;
use app\module\admin\models\MedicinesSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\module\admin\models\GroupMedicines;

/**
 * MedicinesController implements the CRUD actions for Medicines model.
 */
class MedicinesController extends Controller
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
     * Остатки
     * @return mixed
     */
    public function actionResidue()
    {   
        $searchModel = new MedicinesSearch();
        $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);
        
        //$dataProvider = new ActiveDataProvider([
        //    'query' => Medicines::find(),
        //]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    /**
     * Просроченный товар
     * @return mixed
     */
    public function actionOverdue()
    {   
        $searchModel = new MedicinesSearch();
        $dataProvider = $searchModel->search3(Yii::$app->request->queryParams);
        
        //$dataProvider = new ActiveDataProvider([
        //    'query' => Medicines::find(),
        //]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Medicines models.
     * @return mixed
     */
    public function actionIndex()
    {   
        $searchModel = new MedicinesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //$dataProvider = new ActiveDataProvider([
        //    'query' => Medicines::find(),
        //]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medicines model.
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
     * Creates a new Medicines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medicines();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionAdd_group()
    {
        $model = new GroupMedicines();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $model->find(),
        ]);
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                
                Yii::$app->session->setFlash('success', 'Группа добавлена');
                
                return $this->redirect(['add_group']);
            }
        }
    
        return $this->render('add_group', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }
    

    public function actionDelete_type($id)
    {   
        $model = new GroupMedicines();
        
        $model->findOne($id)->delete();
        
        Yii::$app->session->setFlash('success', 'Удалено');
        
        return $this->redirect(['add_group']);
    }
    /**
     * Updates an existing Medicines model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Medicines model.
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
     * Finds the Medicines model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Medicines the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medicines::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Проверяем и выводим нужное кол-во записей 
     * */
    public function actionAjaxMed(){
        
        if(Yii::$app->request->isAjax){
            $id = (int)Yii::$app->request->post('id');
            $count = (int)Yii::$app->request->post('count');
            
            //$search = Medicines::find()->where(['id' => $id])->asArray()->one();
            $sql = 'SELECT * FROM medicines WHERE id = :id AND received >= :received';
            $search = Medicines::findBySql($sql, [':id' => $id, ':received' => $count])->asArray()->one();
            
            if($search)return json_encode($search);
        }
        return false;
    }
}
