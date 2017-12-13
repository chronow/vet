<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\module\admin\models\Clients;

use yii\helpers\Url;
use app\module\admin\models\TypeAnimals;
use app\module\admin\models\Animals;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Pets */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript">
    function ajaxFunc(obj){
        $.post(
            "<?=Url::toRoute('priem/ajax-breed')?>",
            {id: $(obj).val()},
            function(data){
                $("#breed").html(data);
            }
        );
    }
</script>

<div class="pets-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= Html::error($model, 'title', ['class' => 'error']) ?>
    
    <br />
    
    <div class="col-lg-offset-4 col-lg-4">
        <?= $form->field($model, 'name')->textInput() ?>
    
        <?= $form->field($model, 'id_users')->dropDownList(
            ArrayHelper::map(Clients::find()->orderBy(['id' => SORT_DESC])->where("type <> 'admin'")->all(),'id','name'),
            ['promt'=>'Выберите группу']
        )?>
        
        <div class="row">
            <div class="col-sm-6">
            <?= $form->field($model, 'id_type_animals')->dropDownList(
                ArrayHelper::map(TypeAnimals::find()->orderBy(['id' => SORT_ASC])->all(),'id','name'),
                [
                    'promt'=>'Выберите вид',
                    'onchange' => 'ajaxFunc(this)'
                ]
            ) ?>
            </div>
            
            <div class="col-sm-6">
            <?= $form->field($model, 'id_animals')->dropDownList(
                ArrayHelper::map(Animals::find()->orderBy(['id' => SORT_ASC])->all(),'id','breed'),
                ['promt'=>'Выберите породу', 'id'=>'breed']
            ) ?>
            </div>
        </div>
        
        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
    
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить питомца' : 'Редактировать питомца', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        
    </div>
    <?php ActiveForm::end(); ?>

</div>
