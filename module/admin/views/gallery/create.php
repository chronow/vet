<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Gallery */

$this->title = 'Добавить изображение';
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_menu') ?>

<div class="row-fluid">
    <div class="col-lg-12">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    </div>
</div>
