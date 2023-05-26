<?php


namespace app\components;

use app\components\dto\EndpointErrorDto;
use app\components\dto\PlotDto;
use yii\httpclient\Response;

class ApiResponseParser
{
    /** @var Response */
    private $response;
    /** @var array */
    private $responseParsed;

    public function parseResponse(Response $response)
    {
        $this->response = $response;
        $rawBody = $response->getContent();
        $this->responseParsed = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);
    }

    public function getResponseParsed()
    {
        return $this->responseParsed;
    }

    /**
     * @throws UnknownApiResponseException
     */
    public function ensureKnownParsedResponseStructure()
    {
        //todo fill exception with error details: case, context
        //todo validate each known case individually

        $responseCodeIsOk = $this->getResponseStatusCodeIsOk();
        $hasElements = sizeof($this->responseParsed);
        $oneElementIsPlot = $hasElements && isset($this->responseParsed[0]['attrs']);
        $hasExceptionInfo = !$responseCodeIsOk && isset($this->responseParsed['code']);

//        var_dump($responseParsed['']);

        if($responseCodeIsOk && !$hasElements) {
            return;
        }
        elseif($responseCodeIsOk && $oneElementIsPlot) {
            return;
        }
        elseif(!$responseCodeIsOk && $hasExceptionInfo) {
            return;
        }

        throw new UnknownApiResponseException();
    }

    /**
     * @return array
     * @throws UnknownApiResponseException
     */
    public function getResponsePlotDtos(): array
    {
        $this->ensureKnownParsedResponseStructure();
        $responseParsed = $this->getResponseParsed();
        $dtos = [];
        foreach($responseParsed as $plotData) {
            $dto = new PlotDto();
            $dto->id = $plotData['id'];
            $dto->number = $plotData['number'];
            $dto->attrs = $plotData['attrs'];
            $dto->extent = $plotData['extent'];
            $dto->spatial = $plotData['spatial'];
            $dto->_links = $plotData['_links'];
            $dto->created_at = $plotData['created_at'];
            $dto->updated_at = $plotData['updated_at'];
            $dtos[] = $dto;
        }
        return $dtos;
    }

    public function getResponseEndpointErrorDto(): EndpointErrorDto
    {
        $this->ensureKnownParsedResponseStructure();
        $responseParsed = $this->getResponseParsed();
        $dto = new EndpointErrorDto();
        $dto->name = $responseParsed['name'];
        $dto->name = $responseParsed['message'];
        $dto->code = $responseParsed['code'];
        $dto->status = $responseParsed['status'];
        return $dto;
    }

    public function getResponseStatusCode()
    {
        return $this->response->statusCode;
    }

    public function getResponseStatusCodeIsOk()
    {
        return $this->getResponseStatusCode() === '200';
    }

    public function getResponseHeaders()
    {
        return $this->response->headers;
    }

}