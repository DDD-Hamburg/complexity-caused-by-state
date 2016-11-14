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
     * @param string $id
     * @return ShoppingCart
     */
    public function findByUserId(string $id): ShoppingCart
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
