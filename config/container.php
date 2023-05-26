<?php
/** @var $params array */

use yii\di\Instance;

return [
    'definitions' => [
        \app\components\ApiClient::class => [
            ['class' => \app\components\ApiClient::class],
            [
                Instance::of(\yii\httpclient\Client::class),
                $params['api.baseUrl']
            ]
        ],
        \yii\httpclient\Client::class => [
            'baseUrl' => $params['api.baseUrl'],
        ],
        \yii\rest\Serializer::class => [
            'collectionEnvelope' => 'items'
        ]
    ]
];
