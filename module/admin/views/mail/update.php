<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Mail */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Mails', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_menu') ?>

<div class="row-fluid">
    <div class="col-lg-12">

    <h3><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
