<?php

namespace DDDHH\Shop;

use DDDHH\Shop\Cart\Cart;

interface CalculatorService
{
    /**
     * @param Cart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(Cart $cart, float $discount = 1.0, array $discountedItemIds = []): float;

}
