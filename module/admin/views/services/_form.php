<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\module\admin\models\GroupServices;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clear-fix"></div>

<div class="col-md-offset-3 col-md-6">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput() ?>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_group_services')->dropDownList(
                ArrayHelper::map(GroupServices::find()->orderBy(['id' => SORT_ASC])->all(),'id','name'),
                ['promt'=>'Выберите группу']
            )?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать услугу' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
