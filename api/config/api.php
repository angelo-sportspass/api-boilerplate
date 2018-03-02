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

            'rules' => [
                $rules,
                '/' => 'site/index',
                '<action:\w+>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+(-\w+)*>' => '<controller>/<action>'
            ],
        ],

        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],

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

        // Set this enable authentication in our API
        'user' => [
            'class' => 'yii\web\User',
            'identityClass'  => 'app\models\User',
            'enableAutoLogin'  => false, // Don't forget to set Auto login to false
        ],

        'account' => [
            'class' => 'yii\web\User',
            'identityClass'  => 'app\models\Account',
            'enableAutoLogin'  => false, // Don't forget to set Auto login to false
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'info@sportspass.com.au',
                'password' => 'C@@te100!',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

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