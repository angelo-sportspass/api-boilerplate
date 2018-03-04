<?php

$params = require(__DIR__ . '/params.php');
$rules  = require (__DIR__.'/rules.php');

$config = [
    'id' => 'api',
    'basePath'    => dirname(__DIR__).'/..',
    'bootstrap'   => ['log'],
    'components'  => [

        // URL Configuration for our API
        'urlManager'  => [

            'enablePrettyUrl'  => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,

            'rules' => [],
        ],

        'response' => [],

        'request' => [
            // Set Parser to JsonParser to accept Json in request
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json'  => 'yii\web\JsonParser',
            ],
        ],
        'cache'  => [
            'class'  => 'yii\caching\FileCache',
        ],

        // 'mailer' => [ ],

        // Enable logging for API in a api Directory different than web directory
        'log' => [
            'traceLevel'  => YII_DEBUG ? 3 : 0,
            'targets'  => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels'  => ['error', 'warning'],
                    // maintain api logs in api directory
                    'logFile'  => '@api/runtime/logs/error.log'
                ],
            ],
        ],
        'db'  => require(__DIR__ . '/../../config/db.php'),
    ],

    'modules' => [
        'v1' => [
            'basePath' => '@app/api/modules/v1', // base path for our module class
            'class' => 'app\api\modules\v1\Api', // Path to module class
        ]
    ],

    'params'  => $params,
];

return $config;