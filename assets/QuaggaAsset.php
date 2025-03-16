<?php

namespace app\assets;

use yii\web\AssetBundle;

class QuaggaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
        'js/quagga/quagga.min.js',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}