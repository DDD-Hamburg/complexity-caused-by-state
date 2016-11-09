<?php
declare(strict_types=1);

class ShoppingCart {
    /** Item[] $items */
    private $items;

    public function addItem(Item $item) : ShoppingCart {
        $this->items[] = $item;

        return $this;
    }

    public function removeItemByPosition(int $position) : ShoppingCart {
        unset($this->items[$position]);

        return $this;
    }

    /**
     * @return Item[] $items;
     */
    public function getItems()
    {
        return $this->items;
    }

}
