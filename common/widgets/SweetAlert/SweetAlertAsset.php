<?php

namespace common\widgets\SweetAlert;

use yii\web\AssetBundle;

class SweetAlertAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/SweetAlert/assets';

    public $js = [
        'js/sweetalert.min.js'
    ];

    public $css = [
        'css/sweetalert.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}