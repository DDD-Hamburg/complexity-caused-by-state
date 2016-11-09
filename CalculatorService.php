<?php
//declare(strict=1);

/**
 * This class contains an error.
 * If the user adds a particular item to the shopping cart the whole shopping cart will be discounted by 10%
 */
class CalculatorService {
    private $discountActive = false;
    private $itemsWithPromo = [
        'AAA13' => true, 'QY25' => true,
    ];

    public function getTotal(ShoppingCart $shoppingCart) : float
    {
        $total = 0;
        foreach ($shoppingCart->getItems() as $item) {
            if ($this->isItemInPromo($item)) {
                $this->discountActive = true;
            }

            $total += ($item->getPricePerUnity() * $item->getQuantity());
        }

        if ($this->discountActive) {
            $total *= .9;
        }

        return $total;
    }

    private function isItemInPromo(Item $item) : bool
    {
        return isset($this->itemsWithPromo[$item->getId()]);
    }
}
