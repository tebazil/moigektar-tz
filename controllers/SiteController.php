<?php

namespace app\controllers;

use app\components\ApiClient;
use app\components\ApiResponseParser;
use yii\data\ArrayDataProvider;
use yii\rest\Serializer;
use yii\web\Response;

class SiteController extends \yii\web\Controller {

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

}
