<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Settings */

$this->title = 'Создание параметра';
?>

<?= $this->render('_menu') ?>

<div class="col-lg-12">
    <div class="clearfix"></div><br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

