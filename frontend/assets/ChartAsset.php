<?php

namespace frontend\assets;

use yii\web\AssetBundle;


class ChartAsset extends AssetBundle
{

    public $basePath ='@webroot';
    public $baseUrl = '@web';
    public $css = ['JS/Chart.min.css'];

    public $js = ['JS/Chart.min.js'];

    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

?>