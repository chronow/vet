<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>

<div class="clear-fix"></div>

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
            'name:ntext',
            //'username:ntext',
            //'password:ntext',
            //'authKey:ntext',
            //'accessToken:ntext',
            'phone:ntext',
            'email:ntext',
            'note:ntext',
            // 'status:ntext',
            
            // 'type:ntext',
            // 'balance',
            // 'date',
            // 'ip:ntext',

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
