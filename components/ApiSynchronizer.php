<?php


namespace app\components;


use app\components\dto\PlotDto;
use app\models\Cadastre;
use yii\helpers\ArrayHelper;

class ApiSynchronizer
{
    const EXPIRE_TIME_SECONDS = 3600;

    private $apiClient;
    private $apiResponseParser;

    public function __construct(ApiClient $apiClient, ApiResponseParser $apiResponseParser)
    {
        $this->apiClient = $apiClient;
        $this->apiResponseParser = $apiResponseParser;
    }


    public function getUpdatedPlotModels(array $cadastreNumbers)
    {
        /** @var Cadastre[] $models */
        $models = Cadastre::find()->where(['number' => $cadastreNumbers])->indexBy('number')->all();
        $modelsValid = array_filter($models, function(Cadastre $model) {
            return !self::hasModelExpired($model);
        });
        $numbersValid = ArrayHelper::getColumn($modelsValid, 'number');
        $numbersToUpdate = array_diff($cadastreNumbers, $numbersValid);

        if(!$numbersToUpdate) {
            return $models;
        }

        $plotDtos = $this->fetchPlotDtoByNumbers($numbersToUpdate);
        foreach($plotDtos as $plotDto) {
            $model = isset($models[$plotDto->number]) ? $models[$plotDto->number] : new Cadastre();
            $model->fillFromPlotDto($plotDto);
            $model->timestampApiCheck();
            $model->timestampUpdatedAt();
            if ($model->isNewRecord) {
                $model->timestampCreatedAt();
                $models[$model->number] = $model;
            }
            $model->save(false);
        }
        return $models;
    }

    private static function hasModelExpired(Cadastre $model)
    {
        if(!$model->last_api_check_at) {
            return true;
        }
        $timeLastApiCheck = strtotime($model->last_api_check_at);
        if($timeLastApiCheck === false) {
            return true;
        }
        $timeNow = time();
        if(($timeNow - $timeLastApiCheck) >= self::EXPIRE_TIME_SECONDS) {
            return true;
        }
        return false;
    }

    /**
     * @param array $cadastreNumbers
     * @return PlotDto[]
     * @throws UnknownApiResponseException
     * @throws \JsonException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    private function fetchPlotDtoByNumbers(array $cadastreNumbers)
    {
        $response = $this->apiClient->sendRequestCadastreNumbers($cadastreNumbers);
        $apiResponseParser = $this->apiResponseParser;
        $apiResponseParser->parseResponse($response);
        if(!$apiResponseParser->getResponseStatusCodeIsOk()) {
            throw new \Exception(print_r($apiResponseParser->getResponseEndpointErrorDto(), true));
        }
        return $apiResponseParser->getResponsePlotDtos();
    }
}