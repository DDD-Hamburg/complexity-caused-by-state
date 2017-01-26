<?php

namespace DDDHH\Hexagon;

use DDDHH\Shop\Cart\Cart;

class ShoppingCartMapper implements PortMapper {
    const KEY_CART = "cart";
    const KEY_DISCOUNT = "discount";
    const KEY_DISCOUNTED_ITEM_IDS = "discountedItemIds";

    private $cart;
    private $discount;
    private $discountedItemIds;

    /**
     * ShoppingCartMapper constructor.
     * @param Cart $cart
     * @param float $discount
     * @param array $discountedItemIds
     */
    public function __construct(Cart $cart, float $discount = 1.0, array $discountedItemIds = []) {
        $this->cart = $cart;
        $this->discount = $discount;
        $this->discountedItemIds = $discountedItemIds;
    }

    public function getMessage()
    {
        $params = [
            self::KEY_DISCOUNT => $this->discount,
            self::KEY_DISCOUNTED_ITEM_IDS => $this->discountedItemIds,
        ];

        foreach ($this->cart->items() as $key => $param) {
            $params[self::KEY_CART][] = $param->toArray();
        }

        return $params;
    }
}