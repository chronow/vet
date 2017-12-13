<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Animals */

$this->title = 'Update Animals: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?=$this->render('_menu') ?>
<div class="row-fluid">
    <div class="col-lg-12">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	</div>
</div>
