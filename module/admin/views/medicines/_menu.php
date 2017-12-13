
<div class="row-fluid body-menu">
    <div class="col-sm-12">
        <ul>
            <li class="<?if(Yii::$app->controller->action->id=='index' || Yii::$app->controller->action->id=='update'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>">Медикаменты</a></li>			
            <li class="<?if(Yii::$app->controller->action->id=='create'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/create">Добавить медикамент</a></li>
            <li class="<?if(Yii::$app->controller->action->id=='add_group'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/add_group">Добавить группу</a></li>
            
            <li style="border-left: 1px solid #e5e5e5;"><a>&nbsp;</a></li>
            
            <li class="<?if(Yii::$app->controller->action->id=='residue'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/residue">Остатки</a></li>
            <li class="<?if(Yii::$app->controller->action->id=='overdue'):?>active<?endif;?>"><a href="/<?=Yii::$app->controller->module->id?>/<?=Yii::$app->controller->id?>/overdue">Просроченный товар</a></li>
        </ul>
    </div>
</div>