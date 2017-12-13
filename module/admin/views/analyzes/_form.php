<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Analyzes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clear-fix"></div>

<div class="col-md-offset-3 col-md-6">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'baseprice')->textInput() ?>
    
    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'markup')->textInput() ?>
        </div>
        
        <div class="col-md-6">
        <?= $form->field($model, 'type')->dropDownList(['per'=>'%', 'val'=>'Значение'], ['promt'=>'Выберите тип']) ?>
        </div>
    </div>
    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать анализ' : 'Редактировать анализ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
