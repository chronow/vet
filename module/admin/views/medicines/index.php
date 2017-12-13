<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\module\admin\models\Suppliers;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medicines';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>

<div class="clear-fix"></div>

<div class="row-fluid">
    <div class="col-lg-12">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title:ntext',
            
            'titleMedicines',
            /*
            'id_group_medicines'=>[
                'attribute' => 'Вид',
                'value' => function ($model, $key, $index, $widget){
                    return $model->dataGroupMedicines->name;
                },
                'format' => 'raw',
            ],
            */
            
            'id_suppliers'=>[
                'value' => function ($model, $key, $index, $widget){
                    return $model->dataSuppliers->name;
                },
                'format' => 'raw',
                'label'=>'Поставщик',
                'attribute'=>'id_suppliers',
                'filter'=>ArrayHelper::map(Suppliers::find()->all(),'id','name'),
            ],
            'in_stock'=>[
                'label'=>'Наличие',
                'value' => function ($model, $key, $index, $widget){
                    if($model->date_finished<=date("Y-m-d")){
                        $txt = '<span class="label label-danger"><span class="glyphicon glyphicon-flash"></span> Просроченно!</span>';
                    }elseif($model->received>0){
                        if($model->received<20){
                            $txt = '<span class="label label-warning" title="Товар заканчивается!">Есть в наличии</span>';
                        }else{
                            $txt = '<span class="label label-success">Есть в наличии</span>';
                        }
                    }else{
                        $txt = '<span class="label label-danger">Нет</span>';
                    }
                    
                    
                    
                    return $txt;
                },
                'format'=>'html',
            ],
            
            'received',
            'unit_type'=>[
                'label'=>'Ед. изм.',
                'attribute'=>'unit_type',
                'filter'=>array('амп'=>'амп', 'мл'=>'мл', 'мг'=>'мг', 'г'=>'г', 'шт'=>'шт', 'доза'=>'доза', 'уп'=>'уп'),
            ],
            // 'price',
            // 'all_price',
            'price_retail',
            // 'date_start',
            'date_finished',

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
