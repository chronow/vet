<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript">
    /* Получение бланка приема */
    function ajaxFunc(){
        $id=$("#reports-id_priem").val();
        $.post(
            "<?=Url::toRoute('priem/ajax-priem')?>",
            {id: $id},
            function(data){
                $("#priem").html(data);
            }
        );
    }
</script>




<div class="col-md-5">
<div class="col-md-12">

</div>
</div>

<div class="clearfix"></div><br />

<div class="col-md-4 pd_r0">
    <?php $form = ActiveForm::begin(); ?>
    <h3 class="pull-left mr_t0 text-muted">Информация отчёта</h3>
    
    <div class="clearfix"></div>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <?/*
            <div class="row">
                <div class="col-sm-6">
                    <?if(Yii::$app->controller->action->id=='create')$model->date=date("Y-m-d")?>
                    <?= $form->field($model, 'date')->widget(DatePicker::className(),[
                        'options' => ['class' => 'form-control'],
                        'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                        
                    ]) ?>
                </div>
                
                <div class="col-sm-6">
                    <?if(Yii::$app->controller->action->id=='create')$model->time=date("H:i")?>
                    <?= $form->field($model, 'time')->textInput() ?>    
                </div>
            </div>
            */?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'id_priem')->textInput(['placeholder'=>'Укажите номер', 'autofocus'=>true]) ?>
                </div>
                <div class="col-sm-6">
                    <label class="control-label" for="search">&nbsp;</label>
                    <div class="form-group">
                        <div class="btn btn-warning" onclick="ajaxFunc()" style="width: 100%;"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Проверка номера</div>
                    </div>
                </div>
            </div>
        
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
            
            <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Создать отчёт' : 'Редактировать отчёт', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div> 
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-8" id="priem">
    <h3 class="pull-left mr_t0 text-muted">Бланк приёма #</h3>
    <div class="clearfix"></div>
    <div class="panel panel-warning">
        <div class="panel-heading text-uppercase">
            <span class="glyphicon glyphicon-exclamation-sign"></span> Не указан id бланка приема
        </div>
        <div class="panel-body">Укажите номер бланка приёма</div>
    </div>
</div>

<div class="clearfix"></div>




<?if(intval($model->id_priem)>0):?>
<script type="text/javascript">
    $(document).ready(function(){
    	ajaxFunc();
    });
</script>
<?endif;?>