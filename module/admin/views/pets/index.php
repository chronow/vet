<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\PetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pets';
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
            /*
            'id_users'=>[
                'attribute' => 'Владелец',
                'value' => function ($model, $key, $index, $widget){
                    return '<a href="/admin/clients?ClientsSearch[name]='.$model->nameClientsFunc->name.'" target="_blank">'.$model->nameClientsFunc->name.'</a>';
                },
                'format' => 'raw',
            ],
            */
            'fullName',
            'name:ntext',
            'id_type_animals'=>[
                'attribute' => 'Вид питомца',
                'value' => function ($model, $key, $index, $widget){
                    return $model->typeAnimalsFunc->name;
                },
                'format' => 'raw',
            ],
            'id_animals'=>[
                'attribute' => 'Порода питомца',
                'value' => function ($model, $key, $index, $widget){
                    return $model->breedAnimalsFunc->breed;
                },
                'format' => 'raw',
            ],
            'note:ntext',

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
