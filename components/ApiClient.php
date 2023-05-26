<?php


namespace app\components;


use yii\httpclient\Client;
use yii\httpclient\Response;

class ApiClient
{
    private $client;
    private $apiBaseUrl;
    
    /** @var Response */
    private $response;

    public function __construct(Client $client, string $apiBaseUrl)
    {
        $this->client = $client;
        $this->apiBaseUrl = $apiBaseUrl;
    }

    /**
     * @param $urlPart
     * @param array $data
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function sendRequest($urlPart, array $data)
    {
//        var_dump($this->apiBaseUrl);
//        var_dump($urlPart); exit();
        $request = $this->client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl($urlPart)
            ->setData($data);

        $response = $request->send();
        
        $this->response = $response;

        return $response;
    }

    /**
     * @return Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function sendRequestDefaultValues()
    {
        return $this->sendRequest('plots', [
            'collection' => [
                'plots' => [
                    '69:27:0000022:1306',
                    '69:27:0000022:1307'
                ]
            ]
        ]);
    }

    public function sendRequestCadastreNumbers(array $cadastreNumbers)
    {
        return $this->sendRequest('plots', [
            'collection' => [
                'plots' => $cadastreNumbers
            ]
        ]);
    }


}