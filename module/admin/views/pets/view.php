<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Pets */

$this->title = 'Питомец: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pets', 'url' => ['index']];
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
            'name:ntext',
            //'id_users',
            [
                'label' => 'Владелец',
                'value' => $model->nameClientsFunc->name,
            ],
            //'id_type_animals',
            [
                'label' => 'Вид',
                'value' => $model->typeAnimalsFunc->name,
            ],
            //'id_animals',
            [
                'label' => 'Порода',
                'value' => $model->breedAnimalsFunc->breed,
            ],
            'note',
        ],
    ]) ?>
	</div>
</div>
