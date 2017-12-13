<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\PriemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="priem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'sostoyanie') ?>

    <?php // echo $form->field($model, 'anamnez') ?>

    <?php // echo $form->field($model, 'diagnoz') ?>

    <?php // echo $form->field($model, 'naznachenie') ?>

    <?php // echo $form->field($model, 'summ') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
