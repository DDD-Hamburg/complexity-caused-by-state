<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;
use DDDHH\Shop\CustomerID;

interface Repository
{
    /**
     * @param CustomerID $id
     * @return ShoppingCart|null
     * @throws \RuntimeException
     */
    public function findByCustomerID(CustomerID $id);

    /**
     * @param ShoppingCart $cart
     */
    public function save(ShoppingCart $cart);
}
