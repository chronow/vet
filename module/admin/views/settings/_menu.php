
<div class="row-fluid body-menu">
    <div class="col-sm-12">
        <ul>
            <li class="<?if(Yii::$app->controller->action->id=='index' || Yii::$app->controller->action->id=='update' || Yii::$app->controller->action->id=='view'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>">Настройки</a></li>
            <li class="<?if(Yii::$app->controller->action->id=='create'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/create">Создать параметр</a></li>
        </ul>
    </div>
</div>