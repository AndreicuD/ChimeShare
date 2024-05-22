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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd/M/Y',
            'datetimeFormat' => 'dd/M/Y H:mm',
            'timeFormat' => 'H:mm',
            'locale' => 'ro', //your language locale
            'defaultTimeZone' => 'Europe/Bucharest', // time zone
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
        ],
    ],
];
