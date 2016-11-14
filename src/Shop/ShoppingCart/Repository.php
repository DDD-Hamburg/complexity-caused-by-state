<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;
use DDDHH\Shop\Customer\Id;

interface Repository
{
    /**
     * @param Id $id
     * @return ShoppingCart|null
     * @throws \RuntimeException
     */
    public function findById(Id $id);

    /**
     * @param ShoppingCart $cart
     */
    public function save(ShoppingCart $cart);
}
