<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Clients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
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
            //'username:ntext',
            //'password:ntext',
            //'authKey:ntext',
            //'accessToken:ntext',
            'phone:ntext',
            'name:ntext',
            'email:ntext',
            'address:ntext',
            'note:ntext',
            //'status:ntext',
            
            //'type:ntext',
            //'balance',
            //'date',
            //'ip:ntext',
        ],
    ]) ?>
	</div>
</div>
