<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Priem */

$this->title = 'Бланк приёма #'.$model->id;
?>

<div class="row-fluid">
    <div class="col-lg-12">

    <h3 class="pull-left mr_t0 text-muted"><?= Html::encode($this->title) ?></h3>

    <div class="clearfix"></div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'time:ntext',
            //'client:ntext',
            //'phone:ntext',
            //'id_type_animals',
            /*[
                'label' => 'Вид',
                'value' => $model->typeAnimalsFunc->name,
            ],
            [
                'label' => 'Порода',
                'value' => $model->breedAnimalsFunc->breed,
            ],
            'peet_name',
            */
            'sostoyanie:ntext',
            'anamnez:ntext',
            'diagnoz:ntext',
            'naznachenie:ntext',
            'summ',
        ]
    ]) ?>
	</div>
</div>
