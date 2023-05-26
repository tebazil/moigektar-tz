<?php

namespace app\components\dto;

use app\components\BaseDto;

class PlotDto extends BaseDto
{
    public $id;
    public $number;
    public $attrs;
    public $extent;
    public $center;
    public $spatial;

    public $_links;

    public $created_at;
    public $updated_at;
}