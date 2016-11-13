<?php

namespace DDDHH\Shop;

class CalculatorService
{
    /**
     * @param ShoppingCart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(ShoppingCart $cart, float $discount = 1.0, array $discountedItemIds = []): float
    {
        $total = 0.0;
        $discountActive = false;

        foreach ($cart->items() as $item) {
            $total += $item->quantity() * $item->pricePerUnit();

            if (in_array($item->id(), $discountedItemIds)) {
                $discountActive = true;
            }
        }

        if ($discountActive) {
            $total *= $discount;
        }

        return $total;
    }
}
