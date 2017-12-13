<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Medicines */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Medicines', 'url' => ['index']];
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
            'title:ntext',
            'id_group_medicines',
            'id_suppliers',
            'in_stock',
            'unit_type',
            'received',
            'price',
            'all_price',
            'price_retail',
            'date_start',
            'date_finished',
        ],
    ]) ?>
	</div>
</div>
