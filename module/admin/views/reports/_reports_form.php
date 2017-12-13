<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\AutoComplete;
use yii\web\JsExpression;

use yii\helpers\Url;
?>

<script type="text/javascript">
    /* Увеличение и просчет кол-ва */
    function ajaxMed($type){
        $count=$("#reports-medcount").val();
        if($count=='')$count=0;
        
        if($type==0){$count--;}
        else if($type==1){$count++;}
        
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
    /* Отправка на обработку */
    function ajaxMedSend(){
        $idRep = $("#idRep").val();
        $medId = $("#reports-medid").val();
        $medCount = $("#reports-medcount").val();
                
        $.post(
            "<?=Url::toRoute('reports/ajax-medicines-create')?>",
            {idRep: $idRep, medId: $medId, medCount:$medCount},
            function(data){
                $("#medReload").html(data.html);
                $("#priem-summ").val(data.summ);
            },
            "json"
        );
    }
    /* Удаление позиции */
    function delMed($id){
        $.post(
            "<?=Url::toRoute('reports/ajax-medicines-delete')?>",
            {id: $id},
            function(data){
                $("#medReload").html(data.html);
                $("#priem-summ").val(data.summ);
            },
            "json"
        );
    }
</script>

<div class="clearfix"></div>

<div class="col-lg-12"><h3 class="pull-left mr_t0" id="repAnchor">Отчёты</h3></div>
<input type="hidden" id="idRep" name="idRep" value="<?=$model->id?>" />

<div class="clear-fix"></div>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">ДОБАВЛЕНИЕ МЕДИКАМЕНТА В ОТЧЁТ</div>
        <div class="panel-body">
            
            <?php $form1 = ActiveForm::begin([
                //'action' => ['reports/ajax-medicines-create', 'id'=>$model->id],
                //'options' => [
                //    'class' => 'form',
                //],
            ]);?>
            <table class="table table-striped">
                <th>Поиск по названию</th>
                <th style="width: 150px;" class="text-center">Кол-во</th>
                <th>Цена</th>
                <th></th>
                <tr>
                    <td>
                        <div class="form-group">
                            <?= $form1->field($model, 'medTitle')->textInput()->label(false)->widget(AutoComplete::classname(), [
                                'options' => [
                                    'id'=>'reports-medtitle',
                                    'class' => 'form-control',
                                    'placeholder' => 'Поиск'
                                ],
                                'clientOptions' => [
                                    'source' => $listMedicines,
                                    'minLength' => '1',
                                    'select' => new JsExpression("function( event, ui ) {      console.log(ui);
                                                    $('#reports-medtitle').val(ui.item.label);
                                                    $('#reports-medid').val(ui.item.id);
                                                }"),
                                ],
                                'clientEvents' => []
                            ]) ?>
                            <?= Html::activeHiddenInput($model, 'medId', ['id'=>'reports-medid']) ?>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon pointer" onclick="ajaxMed(0)"><span class="glyphicon glyphicon-minus"></span></div>
                            <?= $form1->field($model, 'medCount', ['template' => "{input}"])->textInput([
                            'id'=>'reports-medcount',
                            'value'=>'0', 
                            'class'=>'form-control text-center',
                            'onChange'=>'ajaxMed()',
                            ])?>
                            <div class="input-group-addon pointer" onclick="ajaxMed(1)"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label id="medPrice" class="control-label pd_t8">0 руб</label>
                        </div>
                    </td>
                    <td>
                        <div class="btn btn-default" onclick="ajaxMedSend()">Добавить</div>
                        <?//= Html::a("Добавить", ['reports/ajax-medicines-create'], ['class' => 'btn btn-default']) ?>
                    </td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="col-lg-6" id="medReload"><?=$medReload?></div>



<div class="clear-fix"></div>




<script type="text/javascript">
    /* Увеличение и просчет кол-ва */
    function ajaxAna($type){
        $count=$("#reports-anacount").val();
        if($count=='')$count=0;
        
        if($type==0){$count--;}
        else if($type==1){$count++;}
        
        if($count<=0){
            $count=0;
            $("#reports-anacount").val(0);
            $("#anaPrice").html(0);
            return true;
        }
        $id = $("#reports-anaid").val();
        
        $.post(
            "<?=Url::toRoute('analyzes/ajax-ana')?>",
            {id: $id, count:$count},
            function(data){
                $("#reports-anacount").val($count);
                $("#anaPrice").html(data.price*$count);
            },
            "json"
        );
    }
    /* Отправка на обработку */
    function ajaxAnaSend(){
        $idRep = $("#idRep").val();
        $anaId = $("#reports-anaid").val();
        $anaCount = $("#reports-anacount").val();
                
        $.post(
            "<?=Url::toRoute('reports/ajax-analyzes-create')?>",
            {idRep: $idRep, anaId: $anaId, anaCount:$anaCount},
            function(data){
                $("#anaReload").html(data.html);
                $("#priem-summ").val(data.summ);
            },
            "json"
        );
    }
    /* Удаление позиции */
    function delAna($id){
        $.post(
            "<?=Url::toRoute('reports/ajax-analyzes-delete')?>",
            {id: $id},
            function(data){
                $("#anaReload").html(data.html);
                $("#priem-summ").val(data.summ);
            },
            "json"
        );
    }
</script>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">ДОБАВЛЕНИЕ АНАЛИЗОВ В ОТЧЁТ</div>
        <div class="panel-body">
            
            <?php $form2 = ActiveForm::begin();?>
            <table class="table table-striped">
                <th>Поиск по названию</th>
                <th style="width: 150px;" class="text-center">Кол-во</th>
                <th>Цена</th>
                <th></th>
                <tr>
                    <td>
                        <div class="form-group">
                            <?= $form2->field($model, 'anaTitle')->textInput()->label(false)->widget(AutoComplete::classname(), [
                                'options' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Поиск'
                                ],
                                'clientOptions' => [
                                    'source' => $listAnalyzes,
                                    'minLength' => '1',
                                    'select' => new JsExpression("function( event, ui ) {      console.log(ui);
                                                    $('#reports-anatitle').val(ui.item.label);
                                                    $('#reports-anaid').val(ui.item.id);
                                                }"),
                                ],
                                'clientEvents' => []
                            ]) ?>
                            <?= Html::activeHiddenInput($model, 'anaId') ?>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon pointer" onclick="ajaxAna(0)"><span class="glyphicon glyphicon-minus"></span></div>
                            <?= $form2->field($model, 'anaCount', ['template' => "{input}"])->textInput([
                            'value'=>'0', 
                            'class'=>'form-control text-center',
                            'onChange'=>'ajaxAna()',
                            ])?>
                            <div class="input-group-addon pointer" onclick="ajaxAna(1)"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label id="anaPrice" class="control-label pd_t8">0 руб</label>
                        </div>
                    </td>
                    <td>
                        <div class="btn btn-default" onclick="ajaxAnaSend()">Добавить</div>
                        <?//= Html::a("Добавить", ['reports/ajax-analyzes-create'], ['class' => 'btn btn-default']) ?>
                    </td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="col-lg-6" id="anaReload"><?=$anaReload?></div>




<div class="clear-fix"></div>




<script type="text/javascript">
    /* Увеличение и просчет кол-ва */
    function ajaxSer($type){
        $count=$("#reports-sercount").val();
        if($count=='')$count=0;
        
        if($type==0){$count--;}
        else if($type==1){$count++;}
        
        if($count<=0){
            $count=0;
            $("#reports-sercount").val(0);
            $("#serPrice").html(0);
            return true;
        }
        $id = $("#reports-serid").val();
        
        $.post(
            "<?=Url::toRoute('services/ajax-ser')?>",
            {id: $id, count:$count},
            function(data){
                $("#reports-sercount").val($count);
                $("#serPrice").html(data.price*$count);
            },
            "json"
        );
    }
    /* Отправка на обработку */
    function ajaxSerSend(){
        $idRep = $("#idRep").val();
        $serId = $("#reports-serid").val();
        $serCount = $("#reports-sercount").val();
                
        $.post(
            "<?=Url::toRoute('reports/ajax-services-create')?>",
            {idRep: $idRep, serId: $serId, serCount:$serCount},
            function(data){
                $("#serReload").html(data.html);
                $("#priem-summ").val(data.summ);
            },
            "json"
        );
    }
    /* Удаление позиции */
    function delSer($id){
        $.post(
            "<?=Url::toRoute('reports/ajax-services-delete')?>",
            {id: $id},
            function(data){
                $("#serReload").html(data.html);
                $("#priem-summ").val(data.summ);
            },
            "json"
        );
    }
</script>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">ДОБАВЛЕНИЕ СЕРВИСОВ В ОТЧЁТ</div>
        <div class="panel-body">
            
            <?php $form3 = ActiveForm::begin();?>
            <table class="table table-striped">
                <th>Поиск по названию</th>
                <th style="width: 150px;" class="text-center">Кол-во</th>
                <th>Цена</th>
                <th></th>
                <tr>
                    <td>
                        <div class="form-group">
                            <?= $form3->field($model, 'serTitle')->textInput()->label(false)->widget(AutoComplete::classname(), [
                                'options' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Поиск'
                                ],
                                'clientOptions' => [
                                    'source' => $listServices,
                                    'minLength' => '1',
                                    'select' => new JsExpression("function( event, ui ) {      console.log(ui);
                                                    $('#reports-sertitle').val(ui.item.label);
                                                    $('#reports-serid').val(ui.item.id);
                                                }"),
                                ],
                                'clientEvents' => []
                            ]) ?>
                            <?= Html::activeHiddenInput($model, 'serId') ?>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon pointer" onclick="ajaxSer(0)"><span class="glyphicon glyphicon-minus"></span></div>
                            <?= $form3->field($model, 'serCount', ['template' => "{input}"])->textInput([
                            'value'=>'0', 
                            'class'=>'form-control text-center',
                            'onChange'=>'ajaxSer()',
                            ])?>
                            <div class="input-group-addon pointer" onclick="ajaxSer(1)"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label id="serPrice" class="control-label pd_t8">0 руб</label>
                        </div>
                    </td>
                    <td>
                        <div class="btn btn-default" onclick="ajaxSerSend()">Добавить</div>
                        <?//= Html::a("Добавить", ['reports/ajax-services-create'], ['class' => 'btn btn-default']) ?>
                    </td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="col-lg-6" id="serReload"><?=$serReload?></div>

