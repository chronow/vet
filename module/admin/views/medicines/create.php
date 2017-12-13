<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Medicines */

$this->title = 'Создание медикамента';
$this->params['breadcrumbs'][] = ['label' => 'Medicines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>

<div class="row-fluid">
    <div class="col-lg-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	</div>
</div>
