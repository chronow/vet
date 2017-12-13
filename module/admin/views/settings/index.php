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
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['style' => 'width:20px;'],
                            ],
                'name:ntext',
                'v:ntext',
                'k:ntext',
                'type',
    
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