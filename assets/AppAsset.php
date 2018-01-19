<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot'; //en web para que sean direcciones publicas
    public $baseUrl = '@web';
    public $css = [ //aqui se ponen los css que se quieren cargar
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [  //aqui se ponen todas las dependencias de componentes que deben
        //estar en la carpeta de vendor
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}
