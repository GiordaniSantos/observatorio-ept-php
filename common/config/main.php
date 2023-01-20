<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'pt-BR',
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'UTC',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat'=>'php:d/m/Y H:i',
            'timeFormat'=>'php:H:i',
            'currencyCode' => 'BRL',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'nullDisplay' => '',
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
                'date' => 'dd/MM/yyyy',
                'time' => 'HH:mm',
                'datetime' => 'dd/MM/yyyy HH:mm', 
            ],
            'saveSettings' => [
                'date' => 'php:Y-m-d',
                'time' => 'php:H:i:s',
                'datetime'=> 'php:Y-m-d H:i:s',
            ],
            'autoWidget' => true,
            'autoWidgetSettings' => [
                'date' => ['pluginOptions'=>['autoclose'=>true]],
                'time' => ['pluginOptions'=>[
                    'autoclose' => true,
                    'showMeridian' => false,
                    'defaultTime' => false
                ]],
                'datetime' => ['pluginOptions'=>['autoclose'=>true]]
            ],
        ],
    ], 
    'timeZone' => 'America/Sao_Paulo',
    'language' => 'pt-BR',
    'params' => [
        'icon-framework' => 'fa',
        'bsVersion' => '5.x'
    ],
];
