<?php

namespace DDDHH\Shop;

use DDDHH\Shop\ShoppingCart\Item;

class ShoppingCart
{
    /** @var Items[] */
    private $items;

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
}
