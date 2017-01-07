<?php

namespace DDDHH\Shop\ExternalCalculatorService;

use DDDHH\Hexagon\Adapter;

class JsonAdapter extends Adapter
{
    public function response($content)
    {
        return \GuzzleHttp\json_decode($content);
    }

}