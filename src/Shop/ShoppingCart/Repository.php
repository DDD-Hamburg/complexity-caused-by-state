<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;

interface Repository
{
    /**
     * @param string $id
     * @return ShoppingCart
     */
    public function findByUserId(string $id): ShoppingCart;

    /**
     * @param ShoppingCart $cart
     */
    public function save(ShoppingCart $cart);
}
