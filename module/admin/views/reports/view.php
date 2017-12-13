<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Reports */

$this->title = "Отчёт #".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_menu') ?>
<div class="row-fluid">
    <div class="col-lg-12">

    <h3 class="pull-left mr_t8"><?= Html::encode($this->title) ?></h3>

    <div class="pull-right">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    
    <div class="clearfix"></div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_priem',
            'date',
            'time:ntext',
            'note:ntext',
        ],
    ]) ?>
	</div>
</div>
