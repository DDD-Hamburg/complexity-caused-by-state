<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;

interface Repository
{
    /**
     * @param CustomerID $id
     * @return ShoppingCart
     */
    public function findByCustomerID(CustomerID $id): ShoppingCart;

    /**
     * @param ShoppingCart $cart
     */
    public function save(ShoppingCart $cart);
}
