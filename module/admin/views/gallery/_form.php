<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\module\admin\models\Portfolio;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="clearfix"></div><br />

<div class="col-md-6 col-md-offset-3">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], "id" => "upload_form"]); ?>

    <?/*= $form->field($model, 'id_project')->dropDownList(
            ArrayHelper::map(Portfolio::find()->orderBy(['id' => SORT_DESC])->all(),'id','title'),
            ['promt'=>'Выберите проект']
        ) */?>
    
    
    <?= $form->field($model, 'img_original')->fileInput(); ?>
    
    <?= $form->field($model, 'title')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
