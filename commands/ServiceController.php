<?php


namespace app\commands;


use app\components\ApiClient;
use app\components\ApiResponseParser;
use app\components\ApiSynchronizer;
use app\components\CadastreNumberValidator;
use app\components\dto\PlotDto;
use app\models\Cadastre;
use yii\console\Controller;
use yii\console\widgets\Table;
use yii\httpclient\Client;

class ServiceController extends Controller
{
    private $apiSynchronizer;
    private $cadastreNumberValidator;

    public function __construct($id, $module, ApiSynchronizer $apiSynchronizer, CadastreNumberValidator  $cadastreNumberValidator, $config = [])
    {
        $this->apiSynchronizer = $apiSynchronizer;
        $this->cadastreNumberValidator = $cadastreNumberValidator;
        parent::__construct($id, $module, $config);
    }

    public function actionRun(string $cadastreNumbers)
    {
        $cadastreNumbers = explode(',', $cadastreNumbers);
        $cadastreNumbers = array_filter($cadastreNumbers);
        $this->cadastreNumberValidator->ensureNumbersAreValid($cadastreNumbers);

        $models = $this->apiSynchronizer->getUpdatedPlotModels($cadastreNumbers);

        $out = \Yii::$container->get(Table::class)->setHeaders(
            ['CN', 'Address', 'Price', 'Area']
        )->setRows(
            array_map(function(Cadastre $model) {
                return
                    [
                        $model->number,
                        $model->address,
                        $model->price,
                        $model->area
                    ];
            }, $models))->run();
        echo $out;
    }
}