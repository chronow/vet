<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Priem */

$this->title = 'Обновить бланк: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Priems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?=$this->render('_menu') ?>

<div class="clearfix"></div>

<div class="row-fluid">
    <div class="col-lg-12">

        <h3><?= Html::encode($this->title) ?></h3>
    
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        
        <div class="clear-fix"></div>
        
        <?= $this->render('/reports/_reports_form', [
            'model' => $reportsInfo,
            'listMedicines' => $listMedicines,
            'medReload' => $medReload,
            'listAnalyzes' => $listAnalyzes,
            'anaReload' => $anaReload,
            'listServices' => $listServices,
            'serReload' => $serReload,
        ]) ?>
        
	</div>
</div>
