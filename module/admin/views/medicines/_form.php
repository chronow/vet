<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\module\admin\models\Suppliers;
use app\module\admin\models\GroupMedicines;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Medicines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clear-fix"></div>

<div class="col-md-offset-3 col-md-6">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'title')->textInput() ?></div>
        
        <div class="col-md-6">
        <?= $form->field($model, 'id_suppliers')->dropDownList(
            ArrayHelper::map(Suppliers::find()->orderBy(['id' => SORT_DESC])->all(),'id','name'),
            ['promt'=>'Выберите поставщика']
        )?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_group_medicines')->dropDownList(
                ArrayHelper::map(GroupMedicines::find()->orderBy(['id' => SORT_DESC])->all(),'id','name'),
                ['promt'=>'Выберите группу']
            )?>
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'unit_type')->dropDownList(['амп'=>'амп', 'мл'=>'мл', 'мг'=>'мг', 'г'=>'г', 'шт'=>'шт', 'доза'=>'доза', 'уп'=>'уп'], ['promt'=>'Выберите ед. изм.']) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'in_stock')->radioList([1=>'Есть в наличии', 0=>'Нет в наличии'], [
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="checkbox-inline' . ($checked ? ' active' : '') . '">' .
                Html::radio($name, $checked, ['value' => $value, 'class' => 'mr_r12']) . $label . '</label>';
        }
    ])?>

    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'received')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'all_price')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price_retail')->textInput() ?>
        </div>
    </div>
    

    

    
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date_start')->widget(DatePicker::className(),[
                'options' => ['class' => 'form-control'],
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
        
        <div class="col-md-6">
        <?= $form->field($model, 'date_finished')->widget(DatePicker::className(),[
            'options' => ['class' => 'form-control'],
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
        ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
