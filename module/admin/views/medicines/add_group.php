<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Medicines */
/* @var $form ActiveForm */
?>
<?= $this->render('_menu') ?>

<div class="clearfix"></div><br />

<div class="row-fluid">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'form-inline'
            ]
        ]); ?>
        
        <div class="form-group">
            <label for="exampleInputName2">Группа медикаментов:</label>
            <input type="text" class="form-control" name="GroupMedicines[name]" id="GroupMedicines-name" aria-required="true" />
        </div>
        
        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?//= $form->field($model, 'name') ?>
    
        <?php ActiveForm::end(); ?>
        
        
        <div class="clearfix"></div><br />
        
        
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn',
             'headerOptions' => ['style' => 'width:71px;'],
             'template' => '{delete}',
             'buttons' => [
                'delete' => function($url, $model, $key){
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>', 'delete_type?id='.$key, ['class' => 'btn btn-danger btn-xs']);
                            },
              ],
            ],
        ],
    ]); ?>
        
    </div>
</div><!-- create_type -->
