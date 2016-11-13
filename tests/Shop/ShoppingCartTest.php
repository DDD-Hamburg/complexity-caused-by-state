<?php

namespace DDDHH\Shop;

use DDDHH\Shop\ShoppingCart\Item;

use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldAddRetrieveAndDeleteItem()
    {
        $cart = new ShoppingCart();

        $item = new Item(
            'AAXX-4711',
            'A Book',
            1.99,
            1
        );

        $cart->addItem($item);
        $this->assertContains($item, $cart->items());

        $cart->removeItem($item);
        $this->assertNotContains($item, $cart->items());
    }
}
