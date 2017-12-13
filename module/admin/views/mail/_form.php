<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Mail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-form">

    
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-6 col-md-offset-3">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'status')->dropDownList(['new' => 'Сохранить как новое', 'old' => 'Сохранить как прочитанное', 'send' => 'Отправить письмо'], ['promt'=>'Выберите статус']) ?>
    </div>
    
    <div class="clearfix"></div>
    
    <?=$form->field($model, 'text')->widget(CKEditor::className(),
        ['editorOptions' => [
             'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
             'inline' => false, //по умолчанию false
            ],
        ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать сообщение' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
