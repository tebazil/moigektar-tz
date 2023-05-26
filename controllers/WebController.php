<?php


namespace app\controllers;


use app\components\ApiSynchronizer;
use app\components\CadastreNumberValidator;
use app\models\Cadastre;
use yii\data\ArrayDataProvider;
use yii\rest\Serializer;
use yii\web\Controller;

class WebController extends Controller
{

    private $apiSynchronizer;
    private $cadastreNumberValidator;

    public function __construct($id, $module, ApiSynchronizer $apiSynchronizer, CadastreNumberValidator  $cadastreNumberValidator, $config = [])
    {
        $this->apiSynchronizer = $apiSynchronizer;
        $this->cadastreNumberValidator = $cadastreNumberValidator;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $cadastreNumbers = $_GET['cadastreNumbers'] ?? '';
        $cadastreNumbers = array_filter(explode(',', $cadastreNumbers));
        $this->cadastreNumberValidator->ensureNumbersAreValid($cadastreNumbers);
        $models = $this->apiSynchronizer->getUpdatedPlotModels($cadastreNumbers);

        $dp = new ArrayDataProvider([
            'allModels' => array_map(function(Cadastre $model) {
                return [
                    'cadastre_number' => $model->number,
                    'address' => $model->address,
                    'price' => $model->price,
                    'area' => $model->area
                ];
            }, $models)
        ]);
        return $this->renderPartial('index', ['dp'=> $dp]);
    }
}