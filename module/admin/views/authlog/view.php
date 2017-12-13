<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\AuthLog */

$this->title = "Просмотр: #".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auth Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_menu') ?>

<div class="row-fluid">
    <div class="col-lg-12">

        <h3 class="pull-left"><?= Html::encode($this->title) ?></h3>
    
        <p class="pull-right mr_t12">
            <?= Html::a('Назад', ['/admin/'.Yii::$app->controller->id], ['class' => 'btn btn-default']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы точно хотите удалить?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'status:ntext',
                'user:ntext',
                'time:datetime',
                'ip:ntext',
            ],
        ]) ?>
    </div>
</div>
