<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Priem */

$this->title = 'Бланк приёма #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Priems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>
<div class="row-fluid">
    <div class="col-lg-12">

    <h3 class="pull-left mr_t8"><span class="glyphicon glyphicon-file"></span> <?= Html::encode($this->title) ?></h3>

    <div class="pull-right">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    
    <div class="clearfix"></div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Дата | Время',
                'value' => $model->date.' | '.$model->time,
            ],
            [
                'label' => 'Клиент | Тел.',
                'value' => $model->nameClientsFunc->name.' | '.$model->nameClientsFunc->phone,
            ],
            [
                'label' => 'Питомец | Вид | Порода',
                'value' => $model->typePetsFunc->name.' | '.$model->typeAnimalsFunc->name.' | '.$model->breedAnimalsFunc->breed,
            ],
            
            'sostoyanie:ntext',
            'anamnez:ntext',
            'diagnoz:ntext',
            'naznachenie:ntext',
            [
                'label' => 'Итоговая сумма',
                'value' => '<b>'.$model->summ.' руб.</b>',
                'format' => 'html'
            ],
        ],
    ]) ?>
    
    <?if($reports_medicines):?>
    <div class="clearfix"></div>
    <h3 class="pull-left mr_t8"><span class="glyphicon glyphicon-duplicate"></span> <?= Html::encode("Отчёт по медикаментам") ?></h3>
    <div class="clearfix"></div>
    
    <?= $reports_medicines ?>
    <?endif;?>
    
    <?if($reports_analyzes):?>
    <div class="clearfix"></div>
    <h3 class="pull-left mr_t8"><span class="glyphicon glyphicon-duplicate"></span> <?= Html::encode("Отчёт по анализам") ?></h3>
    <div class="clearfix"></div>
    
    <?= $reports_analyzes ?>
    <?endif;?>
    
    <?if($reports_services):?>
    <div class="clearfix"></div>
    <h3 class="pull-left mr_t8"><span class="glyphicon glyphicon-duplicate"></span> <?= Html::encode("Отчёт по услугам") ?></h3>
    <div class="clearfix"></div>
    
    <?= $reports_services ?>
    <?endif;?>
    
    <div class="clearfix"></div>
	</div>
</div>
