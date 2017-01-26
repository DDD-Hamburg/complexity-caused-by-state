<?php

namespace DDDHH\Shop\ExternalCalculatorService;

use DDDHH\Hexagon\Adapter;
use Psr\Http\Message\ResponseInterface;

class JsonAdapter extends Adapter
{
    public function response(ResponseInterface $content)
    {
        return \GuzzleHttp\json_decode($content->getBody());
    }

}