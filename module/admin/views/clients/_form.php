<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= Html::error($model, 'title', ['class' => 'error']) ?>
    
    <br />
    
    <div class="col-lg-offset-4 col-lg-4">
        <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>
        
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            
        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
        
        <?= Html::submitButton($model->isNewRecord ? 'Добавить клиента' : 'Обновить информацию', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
    </div>
    <?php ActiveForm::end(); ?>

</div>
