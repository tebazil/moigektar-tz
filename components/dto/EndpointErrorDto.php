<?php

namespace app\components\dto;

use app\components\BaseDto;

class EndpointErrorDto extends BaseDto
{
    public $name;
    public $message;
    public $code;
    public $status;
}