<?php

namespace DDDHH\Shop;

use DDDHH\Shop\Cart\Cart;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class ExternalCalculatorService implements CalculatorService
{
    const KEY_CART = 'cart';
    const KEY_DISCOUNT = 'discount';
    const KEY_DISCOUNTED_ITEM_IDS = 'discountedItemIds';

    /**
     * @return array
     */
    private function prepareParams(array $cartItems = [], float $discount = 1.0, array $discountedItemIds = []) {
        $params = [
            self::KEY_DISCOUNT => $discount,
            self::KEY_DISCOUNTED_ITEM_IDS => $discountedItemIds,
        ];

        foreach ($cartItems as $key => $param) {
            $params[self::KEY_CART][$key] = $param->toArray();
        }

        return $params;
    }

    /**
     * @param $params
     * @return ResponseInterface
     */
    private function sendRequest($params) {
        $client = new Client();

        try {
            $response = $client->request('POST', 'http://localhost:4000/api/total', [
                'form_params' => $params
            ]);
            return $response;
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }

    /**
     * @param Cart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(Cart $cart, float $discount = 1.0, array $discountedItemIds = []): float
    {
        $params = $this->prepareParams($cart->items(), $discount, $discountedItemIds);
        $response = $this->sendRequest($params);
        $unencoded = \GuzzleHttp\json_decode($response->getBody());

        return $unencoded;
    }
}
