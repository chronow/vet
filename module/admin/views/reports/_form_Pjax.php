<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

use yii\widgets\Pjax;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript">
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
    
    function ajaxMed($type){
        $count=$("#reports-medcount").val();
        if($count=='')$count=0;
        if($type==0){
            $count--;
        }else{
            $count++;
        }
        if($count<=0){
            $count=0;
            $("#reports-medcount").val(0);
            $("#medPrice").html(0);
            return true;
        }
        $id = $("#reports-medid").val();
        
        $.post(
            "<?=Url::toRoute('medicines/ajax-med')?>",
            {id: $id, count:$count},
            function(data){
                $("#reports-medcount").val($count);
                $("#medPrice").html(data.price_retail*$count);
            },
            "json"
        );
    }
    
    function ajaxMinus(){
        
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
        <div class="panel-body">Укажите номер приёма</div>
    </div>
</div>



<div class="clear-fix"></div>



<?php Pjax::begin(['enablePushState' => false]); ?>
<div class="col-md-6">
    
    <div class="panel panel-default">
        <div class="panel-heading">Медикаменты</div>
        <div class="panel-body">
            
            <?= Html::beginForm(['reports/pjax-medicines-create', 'id'=>$model->id], 'post', ['data-pjax' => '', 'class' => 'form']); ?>
            <table class="table table-striped">
                <th>Название медикамента</th>
                <th style="width: 150px;" class="text-center">Кол-во</th>
                <th>Цена</th>
                <th></th>
                <tr>
                    <td>
                        <div class="form-group">
                            
                            <?= $form->field($model, 'medTitle')->textInput()->label(false)->widget(AutoComplete::classname(), [
                                'options' => [
                                    'class' => 'form-control',
                                ],
                                'clientOptions' => [
                                    'source' => $listMedicines,
                                    'minLength' => '1',
                                    'select' => new JsExpression("function( event, ui ) {      console.log(ui);
                                                    $('#reports-medtitle').val(ui.item.label);
                                                    $('#reports-medid').val(ui.item.id);
                                                }"),
                                ],
                                'clientEvents' => [
                                    
                                ]
                            ]) ?>
                            <?= Html::activeHiddenInput($model, 'medId') ?>
                            
                            
                            <?/*<input id="reports-medid" class="form-control" name="Reports[medId][]" value="" type="text"/>
                            <input id="medTitle-0" class="form-control" name="Reports[medTitle][]" value="" type="text"/>
                            <input id="medid-0" class="form-control" name="Reports[medId][]" value="" type="text"/>
                            */?>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon pointer" onclick="ajaxMed(0)"><span class="glyphicon glyphicon-minus"></span></div>
                            <?= $form->field($model, 'medCount', ['template' => "{input}"])->textInput(['value'=>'0', 'class'=>'form-control text-center'])?>
                            <div class="input-group-addon pointer" onclick="ajaxMed(1)"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label id="medPrice" class="control-label pd_t8">0 руб</label>
                        </div>
                    </td>
                    <td>
                        <?= Html::submitButton('Добавить', ['class' => 'btn btn-default', 'name' => 'med-button']) ?>
                        <?//= Html::a("Добавить", ['reports/ajax-medicines-create'], ['class' => 'btn btn-default']) ?>
                    </td>
                </tr>
            </table>
            <?= Html::endForm() ?>
            
        </div>
    </div>
    <h3></h3>
    <div class="clearfix"></div>
    
</div>
<div class="col-md-6"><?= $medReload ?></div>
<?php Pjax::end(); ?>




<?if(intval($model->id_priem)>0):?>
<script type="text/javascript">
    $(document).ready(function(){
    	ajaxFunc();
    });
</script>
<?endif;?>