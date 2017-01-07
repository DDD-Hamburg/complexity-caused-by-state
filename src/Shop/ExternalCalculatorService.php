<?php

namespace DDDHH\Shop;

use DDDHH\Hexagon\Hexagon;
use DDDHH\Shop\Cart\Cart;

class ExternalCalculatorService extends Hexagon
    implements CalculatorService
{
    const KEY_CART = "cart";
    const KEY_DISCOUNT = "discount";
    const KEY_DISCOUNTED_ITEM_IDS = "discountedItemIds";

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
     * @param Cart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(Cart $cart, float $discount = 1.0, array $discountedItemIds = []): float
    {
        $params = $this->prepareParams($cart->items(), $discount, $discountedItemIds);
        $response = $this->port->request($params);

        return $this->adapter->response($response);
    }
}
