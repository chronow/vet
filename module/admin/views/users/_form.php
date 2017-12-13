<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= Html::error($model, 'title', ['class' => 'error']) ?>
    
    <br />
    
    <div class="col-lg-offset-2 col-lg-8">
        <div class="col-lg-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'status')->dropDownList(['active'=>'Активный', 'block'=>'Заблокированный'], ['promt'=>'Выберите статус']) ?>
            
            <?if(Yii::$app->controller->action->id=='create')echo $form->field($model, 'password')->textInput() ?>
        </div>
        
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'phone')->textInput() ?>
            
            <?= $form->field($model, 'type')->dropDownList(['admin'=>'Администратор', 'user'=>'Пользователь'], ['promt'=>'Выберите тип']) ?>
            
            <?if(Yii::$app->controller->action->id=='create')echo $form->field($model, 'password2')->textInput() ?>
        </div>
        
        
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? 'Создать пользователя' : 'Обновить информацию', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    
    
    <div class="clearfix"></div>
    
    <?if(Yii::$app->controller->action->id=='update'):?>
    <?php $form = ActiveForm::begin(); ?>
    
    <h3>Смена пароля</h3>
    
    <br />
    
    <div class="col-lg-offset-2 col-lg-8">
        <div class="col-lg-6">
            <?if(Yii::$app->controller->action->id=='update')echo $form->field($model, 'password')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?if(Yii::$app->controller->action->id=='update')echo $form->field($model, 'password2')->textInput() ?>
        </div>
        
        <div class="col-md-12">
            <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?endif;?>
</div>
