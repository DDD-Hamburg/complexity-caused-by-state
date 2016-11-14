<?php

namespace DDDHH\Shop\Cart;

use DDDHH\Shop\Cart\Cart;
use DDDHH\Shop\Customer;

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
     * @param Customer\Id $id
     * @return ShoppingCart|null
     * @throws \RuntimeException
     */
    public function findById(Customer\Id $id)
    {
        if (!file_exists($this->filename($id))) {
            return null;
        }
        return unserialize(file_get_contents($this->filename($id)));
    }

    /**
     * @param ShoppingCart $cart
     */
    public function save(Cart $cart)
    {
        file_put_contents($this->filename($cart), serialize($cart));
    }

    /**
     * @param Customer\Id|ShoppingCart
     * @return string
     * @throws \RuntimeException
     */
    private function filename($obj): string
    {
        if (!is_object($obj)) {
            throw \RuntimeException('Wrong argument type!');
        }

        switch (get_class($obj)) {
            case 'DDDHH\Shop\Customer\Id':
                return join('/', [ $this->storagePath, $obj ]);
            case 'DDDHH\Shop\Cart\Cart':
                return join('/', [ $this->storagePath, $obj->customerId() ]);
            default:
                throw new \RuntimeException('Wrong argument type!');
        }
    }
}
