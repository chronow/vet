<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\AuthLog */

$this->title = 'Update Auth Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auth Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
