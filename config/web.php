<?php

use yii\web\UrlNormalizer;

$params = require(__DIR__ . '/params.php');
$container = require(__DIR__ . '/container.php');
//var_dump($container); exit();

$config = [
    'id' => 'web-app',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
            'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oh9qRcXit-CqcyNXPAIB-DvPlOzpqYU9',
                'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\IUser',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                // use temporary redirection instead of permanent for debugging
                'action' => UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'container' => $container,
    'params' => $params,
];

//dd($config); exit();

return $config;
