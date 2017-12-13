<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<?= $this->render('_menu') ?>

<div class="clear-fix"></div>

<div class="row-fluid">
    <div class="col-lg-12">        
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id' => [
                        'attribute' => '#',
                        'headerOptions' => ['style' => 'width:22px;'],
                        'value' => function ($model, $key, $index, $widget){
                            return $model->id;
                        },
                    ],
                'status:ntext',
                'user:ntext',
                'time:datetime',
                'ip:ntext',
    
                ['class' => 'yii\grid\ActionColumn',
                 'headerOptions' => ['style' => 'width:71px;'],
                 'template' => '{view} {delete}',
                 'buttons' => [
                    'view' => function($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['class' => 'btn btn-info btn-xs']);
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