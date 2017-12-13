<?php

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\module\admin\models\Mail;

class DefaultController extends Controller
{   
    public function actionIndex()
    {   
        $model = Mail::find()->orderBy('id asc')->limit(3)->all();
        
        $auth_log = Yii::$app->db->createCommand('SELECT * FROM auth_log ORDER BY id desc LIMIT 0,6')->queryAll();

        
        return $this->render('index', ['model'=>$model, 'auth_log' => $auth_log]); //вызываем внутренний контент этого модуля: module/admin/views/layouts/main.php
    }
}
