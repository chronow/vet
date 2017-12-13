
<div class="row-fluid body-menu">
    <div class="col-sm-12">
        <ul>
            <li class="<?if(Yii::$app->controller->action->id=='index' || Yii::$app->controller->action->id=='update'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>">Животные</a></li>			
            <li class="<?if(Yii::$app->controller->action->id=='create'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/create">Добавить породу</a></li>
            <li class="<?if(Yii::$app->controller->action->id=='create_type'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/create_type">Добавить вид</a></li>
        </ul>
    </div>
</div>