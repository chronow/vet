<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_menu') ?>

<div class="clear-fix"></div>

<div class="row-fluid">
    <div class="col-lg-12">
        
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
    
                'id' => [
                        'attribute' => '#',
                        'headerOptions' => ['style' => 'width:22px;'],
                        'value' => function ($model, $key, $index, $widget){
                            return $model->id;
                        },
                    ],
                'username:ntext',
                'phone',
                'email:ntext',
                'status:ntext',
                'name:ntext',
                'type:ntext',
                
                // 'date',
                // 'ip:ntext',
    
                ['class' => 'yii\grid\ActionColumn',
                 'headerOptions' => ['style' => 'width:71px;'],
                 'template' => '{update} {delete}',
                 'buttons' => [
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