<?php
 
namespace app\assets;
 
use yii\web\AssetBundle;
use Yii;
 
class UploadAssets extends AssetBundle
{
    
    public $sourcePath='@app/widgets';
        
    public $css = [
        'css/upload.css'
    ];
    
    public $js = [
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
    
   
}

