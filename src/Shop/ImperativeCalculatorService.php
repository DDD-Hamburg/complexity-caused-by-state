<?php

namespace DDDHH\Shop;

use DDDHH\Shop\Cart\Cart;

class ImperativeCalculatorService implements CalculatorService
{
    /** @var bool */
    private $discountActive = false;

    /**
     * @param Cart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(Cart $cart, float $discount = 1.0, array $discountedItemIds = []): float
    {
        $total = 0.0;
        foreach ($cart->items() as $item) {
            $total += $item->quantity() * $item->pricePerUnit();

            if (in_array($item->id(), $discountedItemIds)) {
                $this->discountActive = true;
            }
        }

        if ($this->discountActive) {
            $total *= $discount;
        }

        return $total;
    }
}
