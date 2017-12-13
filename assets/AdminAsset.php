<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/admin.css',
        //'css/bootstrap-3.3.5/css/bootstrap.min.css',
    ];
    public $js = [
        //'js/jquery-1.11.3.min.js',
        //'css/bootstrap-3.3.5/js/bootstrap.min.js',
        'js/jquery.synctranslit.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
