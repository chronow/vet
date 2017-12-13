<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\module\admin\models\TypeAnimals;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Animals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-offset-3 col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'breed')->textInput() ?>

    <?= $form->field($model, 'id_type_animals')->dropDownList(
            ArrayHelper::map(TypeAnimals::find()->orderBy(['id' => SORT_DESC])->all(),'id','name'),
            ['promt'=>'Выберите вид']
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
