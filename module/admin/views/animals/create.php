<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Animals */

$this->title = 'Добавление породы';
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
