<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;
use DDDHH\Shop\CustomerID;

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
     * @return ShoppingCart|null
     * @throws \RuntimeException
     */
    public function findByCustomerID(CustomerID $id)
    {
        if (!file_exists($this->filename($id))) {
            return null;
        }
        return unserialize(file_get_contents($this->filename($id)));
    }

    /**
     * @param ShoppingCart $cart
     */
    public function save(ShoppingCart $cart)
    {
        file_put_contents($this->filename($cart), serialize($cart));
    }

    /**
     * @param CustomerID|ShoppingCart
     * @return string
     * @throws \RuntimeException
     */
    private function filename($obj): string
    {
        if (!is_object($obj)) {
            throw \RuntimeException('Wrong argument type!');
        }

        switch (get_class($obj)) {
            case 'DDDHH\Shop\CustomerID':
                return join('/', [ $this->storagePath, $obj ]);
            case 'DDDHH\Shop\ShoppingCart':
                return join('/', [ $this->storagePath, $obj->customerID() ]);
            default:
                throw \RuntimeException('Wrong argument type!');
        }
    }
}
