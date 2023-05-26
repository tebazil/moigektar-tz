<?php


namespace app\controllers;


use app\commands\ServiceController;
use app\components\ApiSynchronizer;
use app\components\CadastreNumberValidator;
use app\models\Cadastre;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\rest\Serializer;
use yii\web\Controller;
use yii\web\Response;

class RestController extends Controller
{
    private $apiSynchronizer;
    private $serializer;
    private $cadastreNumberValidator;

    public function __construct($id, $module, ApiSynchronizer $apiSynchronizer, Serializer $serializer, CadastreNumberValidator  $cadastreNumberValidator, $config = [])
    {
        $this->apiSynchronizer = $apiSynchronizer;
        $this->serializer = $serializer;
        $this->cadastreNumberValidator = $cadastreNumberValidator;
        parent::__construct($id, $module, $config);
    }

    public function beforeAction($action)
    {
        $this->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $result = json_encode($this->runAction('plots'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $this->response->format = Response::FORMAT_HTML;
        return $this->renderPartial('index', ['result' => $result]);
    }

    public function actionPlots()
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
//        var_dump($dp->getPagination()); exit();
        $out = $this->serializer->serialize($dp);
        return $out;
    }


}