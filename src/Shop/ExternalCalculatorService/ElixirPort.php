<?php
namespace DDDHH\Shop\ExternalCalculatorService;

use DDDHH\Hexagon\Port;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class ElixirPort extends Port {


    public function request(array $request = [])
    {
        $client = new Client();

        try {
            $response = $client->request('POST', 'http://localhost:4000/api/total', [
                'form_params' => $request
            ]);
            return $response->getBody();
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }
}
