<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Reports */

$this->title = 'Создание отчёта';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>

<div class="clearfix"></div>

<div class="row-fluid">
    <div class="col-lg-12">
    
    <div class="clearfix"></div><br />
    
    <div class="col-md-7"><h3 class="pull-left mr_t0"><?= Html::encode($this->title) ?></h3></div>
    
    <?= $this->render('_form', [
        'model' => $model,
        //'listMedicines' => $listMedicines,
    ]) ?>
	</div>
</div>
