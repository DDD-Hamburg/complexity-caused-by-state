<?php
namespace DDDHH\Shop\ExternalCalculatorService;

use DDDHH\Hexagon\Port;
use DDDHH\Hexagon\PortMapper;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class GenericPort extends Port {

    public function send(PortMapper $mapper) : ResponseInterface
    {
        $client = new Client();
        return $client->send(
            $this->request,
            [ RequestOptions::FORM_PARAMS => $mapper->getMessage(), ]
        );
    }

}
