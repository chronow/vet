<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\module\admin\models\TypeAnimals;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\PriemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Priems';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>
<div class="row-fluid">
    <div class="col-lg-12">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id' => [
                        'attribute' => '#',
                        'headerOptions' => ['style' => 'width:22px;'],
                        'value' => function ($model, $key, $index, $widget){
                            return $model->id;
                        },
                    ],
            'date'/*=>[
                'attribute' => 'Дата',
                'value' => function ($model, $key, $index, $widget){
                    return $model->date.'<br/>'.$model->time;
                },
            ]*/,
            'time:ntext',
            /*
            'id_type_animals'=>[
                'attribute' => 'Вид',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget){
                    return $model->typeAnimalsFunc->name.'<br/>'.$model->breedAnimalsFunc->breed;
                },
            ],
            
            'id_users'=>[
                'attribute' => 'Клиент ФИО',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget){
                    return $model->nameClientsFunc->name;
                },
            ],*/
            'fullName',
            'phoneNumber',
            /*
            'phone'=>[
                'attribute' => 'Телефон',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget){
                    return $model->nameClientsFunc->phone;
                },
            ],*/
            'id_pets'=>[
                'attribute' => 'Питомец',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget){
                    return $model->typePetsFunc->name;
                },
            ],
            
            
            
            
            
            'id_type_animals'=>[
                'value' => function ($model, $key, $index, $widget){
                    return $model->typeAnimalsFunc->name;
                },
                'format' => 'raw',
                'label'=>'Вид',
                'attribute'=>'id_type_animals',
                'filter'=>ArrayHelper::map(TypeAnimals::find()->all(),'id','name'),
            ],
            /*
            'id_type_animals'=>[
                'attribute' => 'Вид',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget){
                    return $model->typeAnimalsFunc->name;
                },
            ],*/
            
            
            
            
            
            
            
            
            'id_animals'=>[
                'attribute' => 'Порода',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget){
                    return $model->breedAnimalsFunc->breed;
                },
            ],
            
            // 'sostoyanie:ntext',
            //'anamnez:ntext',
            //'diagnoz:ntext',
            //'naznachenie:ntext',
            // 'summ',

            ['class' => 'yii\grid\ActionColumn',
                 'headerOptions' => ['style' => 'width:99px;'],
                 'template' => '{view} {update} {delete}',
                 'buttons' => [
                    'view' => function($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-book"></span>', $url, ['class' => 'btn btn-info btn-xs']);
                                },
                    'update' => function($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['class' => 'btn btn-warning btn-xs']);
                                },
                    'delete' => function($url, $model, $key){
                                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, ['class' => 'btn btn-danger btn-xs']);
                                },
                  ],
            ],
        ],
    ]); ?>
	</div>
</div>
