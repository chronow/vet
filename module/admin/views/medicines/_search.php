<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\MedicinesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicines-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'id_group_medicines') ?>

    <?= $form->field($model, 'id_suppliers') ?>

    <?= $form->field($model, 'in_stock') ?>

    <?php // echo $form->field($model, 'unit_type') ?>

    <?php // echo $form->field($model, 'received') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'all_price') ?>

    <?php // echo $form->field($model, 'price_retail') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_finished') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
