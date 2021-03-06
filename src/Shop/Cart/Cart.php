<?php

namespace DDDHH\Shop\Cart;

use DDDHH\Shop\Customer;

class Cart
{
    /** @var Customer\Id */
    private $customerId;

    /** @var Items[] */
    private $items;

    /**
     * @param Customer\Id $customerId
     * @param Item[] $item
     */
    public function __construct(Customer\Id $customerId, array $items = [])
    {
        $this->customerId = $customerId;
        $this->items = $items;
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $this->items[spl_object_hash($item)] = $item;
    }

    /**
     * @param Item $item
     */
    public function removeItem(Item $item)
    {
        if (isset($this->items[spl_object_hash($item)])) {
            unset($this->items[spl_object_hash($item)]);
        }
    }

    /**
     * @return Item[]
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * @return Customer\Id
     */
    public function customerId(): Customer\Id
    {
        return $this->customerId;
    }
}
