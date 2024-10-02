<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language'   => 'ru-RU', // язык приложения
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'formatter' => [
            'class'             => 'yii\i18n\Formatter',
            'dateFormat'        => 'dd.MM.yyyy',
            'datetimeFormat'    => 'dd.MM.yyyy H:i:s',
            'timeFormat'        => 'H:i:s',
            'defaultTimeZone'   => 'Europe/Moscow',
            'thousandSeparator' => ' ',
            'decimalSeparator'  => ',',
            'nullDisplay'       => '',
        ],
    ],
    'modules'    => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
];
