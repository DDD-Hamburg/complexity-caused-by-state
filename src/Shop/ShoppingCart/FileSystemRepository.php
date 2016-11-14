<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;

class FileSystemRepository implements Repository
{
    /** @var string */
    private $storagePath = '';

    /**
     * @param string $storagePath
     */
    public function __construct(string $storagePath)
    {
        $this->storagePath = $storagePath;
    }

    /**
     * @param CustomerID $id
     * @return ShoppingCart
     */
    public function findByCustomerID(CustomerID $id): ShoppingCart
    {
        throw new Exception("not implemented yet");
    }

    /**
     * @param ShoppingCart $cart
     */
    public function save(ShoppingCart $cart)
    {
        $filename = join('/', [ $this->storagePath, $cart->customerID() ]);
        file_put_contents($filename, serialize($cart));
    }
}
