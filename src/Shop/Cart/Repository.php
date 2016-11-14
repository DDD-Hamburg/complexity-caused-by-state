<?php

namespace DDDHH\Shop\Cart;

use DDDHH\Shop\Cart\Cart;
use DDDHH\Shop\Customer;

interface Repository
{
    /**
     * @param Customer\Id $id
     * @return ShoppingCart|null
     * @throws \RuntimeException
     */
    public function findById(Customer\Id $id);

    /**
     * @param ShoppingCart $cart
     */
    public function save(Cart $cart);
}
