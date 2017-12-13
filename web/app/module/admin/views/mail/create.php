<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Mail */

$this->title = 'Create Mail';
$this->params['breadcrumbs'][] = ['label' => 'Mails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
