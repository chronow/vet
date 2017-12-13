<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_menu') ?>

<div class="row-fluid">
    <div class="col-lg-12">
    
        <div class="clearfix"></div><br />

        <?if($dataProvider):?>
        <?foreach($dataProvider as $m):?>
            <div class="col-md-6">
                <div class="thumbnail">
                    <?=Html::img($m->img_original, ['alt' => 'изображение', 'width' => '100%', 'id'=>'preview']) ?>
                    <div class="caption">
                        <div class="pull-left mr_t8 text-muted">#<?=$m->id?></div>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $m->id], [
                            'class' => 'btn btn-danger pull-right mr_l12',
                            'data' => [
                                'confirm' => 'Вы точно хотите удалить запись?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        
                        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $m->id], [
                            'class' => 'btn btn-info pull-right mr_l12'
                        ]) ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        <?endforeach;?>
        <?endif;?>
    </div>
</div>
