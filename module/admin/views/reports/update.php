<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Reports */

$this->title = 'Редактирование отчёта';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<?php $this->registerCssFile('/web/js/jquery-ui-1.12.1-Autocomplete/jquery-ui.min.css');?>
<?php $this->registerJsFile ('/web/js/jquery-ui-1.12.1-Autocomplete/jquery-ui.min.js'/*, ['position'=>\yii\web\View::POS_HEAD]*/);?>


<?=$this->render('_menu') ?>

<div class="clearfix"></div><br />

<div class="row-fluid">
    <div class="col-lg-12">
    
        <div class="col-md-7"><h3 class="pull-left mr_t0"><?= Html::encode($this->title) ?></h3></div>
    
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        
        <div class="clear-fix"></div>
        
        <?= $this->render('_reports_form', [
            'model' => $model,
            'listMedicines' => $listMedicines,
            'medReload' => $medReload,
            'listAnalyzes' => $listAnalyzes,
            'anaReload' => $anaReload,
            'listServices' => $listServices,
            'serReload' => $serReload,
        ]) ?>
	</div>
</div>
