<?php

namespace DDDHH\Shop;

use DDDHH\Hexagon\Hexagon;
use DDDHH\Hexagon\ShoppingCartMapper;
use DDDHH\Shop\Cart\Cart;

class ExternalCalculatorService extends Hexagon
    implements CalculatorService {

    /**
     * @param Cart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(Cart $cart, float $discount = 1.0, array $discountedItemIds = []): float
    {
        $mapper = new ShoppingCartMapper($cart, $discount, $discountedItemIds);
        $response = $this->port->send($mapper);

        return $this->adapter->response($response);
    }
}
