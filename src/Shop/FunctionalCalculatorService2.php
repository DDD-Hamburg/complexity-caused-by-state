<?php

namespace DDDHH\Shop;

use DDDHH\Shop\Cart\Cart;
use DDDHH\Shop\Cart\Item;

class FunctionalCalculatorService2 implements CalculatorService
{
    /**
     * @param Cart $cart
     * @param float $discount
     * @param string[] $discountedItemIds
     * @return float
     */
    public function total(Cart $cart, float $discount = 1.0, array $discountedItemIds = []): float
    {
        $isDiscounted = false;

        $total = array_reduce(
            $cart->items(),
            function($total, Item $item) {
                $total += $item->quantity() * $item->pricePerUnit();
                return $total;
            }
        );

        if ($isDiscounted) {
            $total *= $discount;
        }

        /** @var Item $item */
        $isDiscounted = array_reduce(
            $cart->items(),
            function($isDiscounted, Item $item) use ($discountedItemIds) {
                $isDiscounted |= in_array($item->id(), $discountedItemIds);
                return $isDiscounted;
            }
        );

        return $total;
    }
}
