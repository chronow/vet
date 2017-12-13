<?php

namespace app\module\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;

use app\module\admin\models\Services;
use app\module\admin\models\ServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\module\admin\models\GroupServices;


/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
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
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
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
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Services();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Services model.
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
     * Deletes an existing Services model.
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
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    
    
    public function actionAdd_group()
    {
        $model = new GroupServices();
        
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
        $model = new GroupServices();
        
        $model->findOne($id)->delete();
        
        Yii::$app->session->setFlash('success', 'Удалено');
        
        return $this->redirect(['add_group']);
    }
    
    
    
    
    /**
     * Проверяем и выводим нужное кол-во записей 
     * */
    public function actionAjaxSer(){
        if(Yii::$app->request->isAjax){
            $id = (int)Yii::$app->request->post('id');
            $count = (int)Yii::$app->request->post('count');
            
            //$search = Services::find()->where(['id' => $id])->asArray()->one();
            $sql = 'SELECT * FROM services WHERE id = :id';
            $search = Services::findBySql($sql, [':id' => $id])->asArray()->one();
            
            if($search)return json_encode($search);
        }
        return false;
    }
}
