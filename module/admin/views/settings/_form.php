<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-6 col-lg-offset-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'k')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'v')->textarea(['rows' => 6]) ?>
        
            <?= $form->field($model, 'type')->dropDownList(['input'=>'input', 'textarea'=>'textarea', 'radio'=>'radio'], ['promt'=>'Выберите тип']) ?>
        
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Создать параметр' : 'Обновить параметр', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
