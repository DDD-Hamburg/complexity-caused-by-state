<?php

namespace DDDHH\Shop;

interface CalculatorService
{
    /**
     * @param ShoppingCart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(ShoppingCart $cart, float $discount = 1.0, array $discountedItemIds = []): float;
}
