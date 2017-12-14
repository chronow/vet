<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


use app\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
    <?php //$this->registerCssFile('../web/css/startbootstrap-sb-admin/css/bootstrap.min.css');?>
</head>
<body>
<?php $this->beginBody() ?>


    <div class="container-fluid">
        <div class="work_content">
            <div class="row-fluid">
                <header>
                    <div class="col-lg-2 col-md-3 bg-green">
                        <div class="row-fluid logo">
                            <div class="col-sm-4 hidden-xs"><a href="/<?=Yii::$app->controller->module->id?>/"><img src="/img/admin/mechanics2.png" /></a></div>
                            <div class="col-sm-8 hidden-xs"><a href="/<?=Yii::$app->controller->module->id?>/"><span>Управление</span></a></div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 bg-white">
                        <div class="col-xs-4">
                            <a class="min-menu hidden-xs" href="/<?=Yii::$app->controller->module->id?>/users">
                                <img src="/img/admin/us.png" />
                            </a>
                            <a class="min-menu hidden-xs" href="/<?=Yii::$app->controller->module->id?>/mail">
                                <div style="position: relative; float: left;">
									<?$new_mail_letter=0;?>
                                    <?//$new_mail_letter = $this->db->read("SELECT COUNT(id) FROM mail WHERE status<>'old' ");?>
                                    <?if($new_mail_letter>0):?><div class="small_count"><?=$new_mail_letter;?></div><?endif;?>
                                    <img src="/img/admin/ms2.png" />
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-xs-4">
                            
                        </div>
                        
                        <div class="col-xs-4">
                            
                            <a href="<?=Yii::$app->urlManager->createUrl(['site/logout'])?>" title="Выход" data-method="post" class="menu"><span class="glyphicon glyphicon-log-out pd_t2 font16"></span><span>Выход</span></a>
                            
                            <a class="menu" href="/">
                                <img src="/img/admin/on.png" />
                                <span>Главная</span>
                            </a>
                            
                        </div>
                    </div>
                </header>
            </div><!-- .row-fluid -->
            
            <div class="clearfix"></div>            
                        
            <div class="row-fluid">
                <div id="body">

                    <div class="col-lg-2 col-md-3 bg-black ">

                        <div class="clearfix"></div>
                        <div class="menu-catalog"><div class="menu-catalog-title"><span class="caret"></span>&nbsp;&nbsp;Основное</div></div>
                        
                        
                        <div class="element_menu">
                            <a class="<?if(Yii::$app->controller->id=='users'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/users" style="">
                                <span class="glyphicon glyphicon-user font20"></span>
                                <span>Сотрудники</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='clients'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/clients" style="">
                                <span class="glyphicon glyphicon-user font20"></span>
                                <span>Клиенты</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='pets'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/pets" style="">
                                <span class="glyphicon glyphicon-star font20"></span>
                                <span>Питомцы</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='priem'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/priem" style="">
                                <span class="glyphicon glyphicon-list-alt font20"></span>
                                <span>Приём</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='reports'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/reports" style="">
                                <span class="glyphicon glyphicon-duplicate font20"></span>
                                <span>Отчёты архив</span>
                            </a>
                            
                            <!--
                            <a class="<?if(Yii::$app->controller->id=='mail'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/mail" style="">
                                <span class="glyphicon glyphicon-envelope font20"></span>
                                <span>Сообщения</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='settings'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/settings" style="">
                                <span class="glyphicon glyphicon-cog font20"></span>
                                <span>Настройки</span>
                            </a>
                            -->
                        </div>
                        
                        
                        <div class="clearfix"></div>
                        <div class="menu-catalog"><div class="menu-catalog-title"><span class="caret"></span>&nbsp;&nbsp;Каталог</div></div>
                        

                        <div class="element_menu" style="display: block;">
                            
                            <a class="<?if(Yii::$app->controller->id=='animals'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/animals" style="">
                                <span class="glyphicon glyphicon-th-list font20"></span>
                                <span>Животные</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='suppliers'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/suppliers" style="">
                                <span class="glyphicon glyphicon-th-list font20"></span>
                                <span>Поставщики</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='medicines'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/medicines" style="">
                                <span class="glyphicon glyphicon-th-list font20"></span>
                                <span>Медикаменты</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='analyzes'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/analyzes" style="">
                                <span class="glyphicon glyphicon-th-list font20"></span>
                                <span>Анализы</span>
                            </a>
                            
                            <a class="<?if(Yii::$app->controller->id=='services'):?>actual_menu<?endif;?>" href="/<?=Yii::$app->controller->module->id?>/services" style="">
                                <span class="glyphicon glyphicon-th-list font20"></span>
                                <span>Услуги</span>
                            </a>
                        </div>
                        
                    </div><!-- .bg-black .element_menu -->
                    
                    <div class="col-lg-10 col-md-9 bg-white">

                        <?= $this->render("flashes") ?>
                        
                        <?= $content ?>


                    </div><!-- .bg-white -->
                </div><!-- #body -->
                
            </div><!-- .row-fluid -->
        </div><!-- .work_content -->
    </div><!-- .container -->
    
    <div class="clearfix"></div>
            
    <div class="container">
        <footer>
            Разработано - <a title="отправить сообщение разработчику" href="mailto:web_script@mail.ru">web_script@mail.ru</a>
        </footer>
    </div>


    <?php //$this->registerJsFile('../web/css/startbootstrap-sb-admin/js/plugins/morris/morris-data.js');?>
    
    <script type="text/javascript">
        $(document).ready(function(){
             $(".menu-catalog").click(function(){
                $(this).next(".element_menu").toggle();
                event.preventDefault();
             });
        });
    
    </script>
    <!--$(document).ready(function(){
             $(".menu-catalog").on('click', 'div', function(){
                $(this).next(".element_menu").css("display","hide");
                alert(1);
             });
        }); -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>