<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Gallery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_menu') ?>

<div class="row-fluid">
    <div class="col-lg-12">

    <h3 class="pull-left"><?= Html::encode($this->title) ?></h3>
    
        <p class="pull-right mr_t12">
            <?= Html::a('Назад', ['/admin/'.Yii::$app->controller->id], ['class' => 'btn btn-default']) ?>
            <?= Html::a('Автообрезка', ['auto_crop', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
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
                'id_project',
                [
                    'attribute' => 'img_original',
                    'label' => 'img_original',
                    'format' => 'raw',
                    'value' => $model->img_original
                ],
                [
                    'attribute' => 'img_800x600',
                    'label' => 'img_800x600',
                    'format' => 'raw',
                    'value' => $model->img_800x600
                ],
                [
                    'attribute' => 'img_373x280',
                    'label' => 'img_373x280',
                    'format' => 'raw',
                    'value' => $model->img_373x280
                ],
                [
                    'attribute' => 'img_150x150',
                    'label' => 'img_150x150',
                    'format' => 'raw',
                    'value' => $model->img_150x150
                ],
                'title:ntext',
            ],
        ]) ?>
        
        <div class="clearfix"></div><br />
        
        <div class="thumbnail">
            <div class="imgInfo"><span class="label label-primary">img_original</span></div>
            <?=Html::img($model['img_original'], ['alt' => 'изображение', 'width' => '100%', 'id'=>'preview']) ?>
        </div>
        
        
        <div class="thumbnail">
            <div class="imgInfo"><span class="label label-primary">img_800x600</span></div>
            <?=Html::img($model['img_800x600'], ['alt' => 'изображение', 'id'=>'preview']) ?>
        </div>
        
        <div class="row">
            <div class="col-md-7">
                <div class="thumbnail">
                    <div class="imgInfo"><span class="label label-primary">img_373x280</span></div>
                    <?=Html::img($model['img_373x280'], ['alt' => 'изображение', 'id'=>'preview']) ?>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="thumbnail">
                    <div class="imgInfo"><span class="label label-primary">img_150x150</span></div>
                    <?=Html::img($model['img_150x150'], ['alt' => 'изображение', 'id'=>'preview']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
