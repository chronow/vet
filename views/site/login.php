<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix"></div><br />

<div class="col-lg-6 col-lg-offset-3">

    <div class="panel panel-default" style="background-color: rgba(252, 250, 250, 0.65);">
      <div class="panel-heading">Панель авторизации в системе</div>
      <div class="panel-body">
        
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-6\">{input}{error}</div>",
                'labelOptions' => ['class' => 'col-lg-3 control-label'],
            ],
        ]); ?>
    
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    
            <?= $form->field($model, 'password')->passwordInput() ?>
    
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-3 col-lg-6\">{input} {label}</div>",
            ]) ?>
    
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width:100%;']) ?>
                </div>
            </div>
    
        <?php ActiveForm::end(); ?>
        
        <div class="clearfix"></div>
      </div>
    </div>
    
</div>