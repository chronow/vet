<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Medicines */

$this->title = 'Редактирование: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Medicines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?=$this->render('_menu') ?>

<div class="clearfix"></div><br />

<div class="row-fluid">
    <div class="col-lg-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	</div>
</div>
