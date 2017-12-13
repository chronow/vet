<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\module\admin\models\Clients;
use app\module\admin\models\Pets;
/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Priem */
/* @var $form yii\widgets\ActiveForm */
?>
    <script type="text/javascript">
        function ajaxFunc($id){
            $.post(
                "<?=Url::toRoute('pets/ajax-pets')?>",
                {id: $id},
                function(data){
                    $("#pets").html(data);
                }
            );
        }
    </script>


    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-offset-2 col-lg-8">
            <div class="col-lg-6">
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
                
                <?= $form->field($model, 'id_users')->dropDownList(
                        ArrayHelper::map(Clients::find()->where("type <> 'admin'")->orderBy(['id' => SORT_DESC])->all(),'id','name'),
                        [
                            'promt'=>'Выберите клиента',
                            'onchange' => 'ajaxFunc(this.value)',
                            'id' => 'id_users'
                        ]
                ) ?>
                
                <?= $form->field($model, 'id_pets')->dropDownList(
                        ArrayHelper::map(Pets::find()->orderBy(['id' => SORT_DESC])->all(),'id','name'),
                        ['promt'=>'Выберите питомца', 'id'=>'pets']
                ) ?>
                                                                                    
                <?= $form->field($model, 'sostoyanie')->textarea(['rows' => 3]) ?>
                
                <?= $form->field($model, 'anamnez')->textarea(['rows' => 3]) ?>
            </div>
            
            <div class="col-lg-6">
                
                <?= $form->field($model, 'diagnoz')->textarea(['rows' => 5]) ?>
            
                <?= $form->field($model, 'naznachenie')->textarea(['rows' => 8]) ?>
            
                <?= $form->field($model, 'summ', [
                'template'=>'<div class="input-group">{input}{error}<span class="input-group-addon">руб</span></div>'
                ])->textInput(['disabled'=>true]) ?>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? 'Создать бланк' : 'Обновить бланк', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style'=>'width:100%']) ?>
            </div>
    <?php ActiveForm::end(); ?>

</div>

    
<script type="text/javascript">
    $(document).ready(function(){
	   ajaxFunc( $("#id_users option:selected").val() );
    });
</script>