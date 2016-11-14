<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;

class FileSystemRepository implements Repository
{
    /** @var string */
    private $storageFile = '';

    /**
     * @param string $storageFile
     */
    public function __construct(string $storageFile)
    {
        $this->storageFile = $storageFile;
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
        if (file_exists($this->storageFile)) {
            $shoppingCarts = unserialize(file_get_contents($this->storageFile));
        } else {
            $shoppingCarts = [];
        }
        $shoppingCarts []= $cart;
        file_put_contents($this->storageFile, serialize($shoppingCarts));
    }
}
