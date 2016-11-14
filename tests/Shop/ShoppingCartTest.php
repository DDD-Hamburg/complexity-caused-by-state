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

    /**
     * @test
     */
    public function itShouldInitializeWithItems()
    {
        $expectedItems = [
            new Item(
                'AAXX-4711',
                'A Book',
                1.99,
                1
            ),
            new Item(
                'BBZZ-3731',
                'Another Book',
                3.99,
                2
            ),
            new Item(
                'CCYY-4115',
                'Yet another Book',
                13.99,
                3
            ),
        ];

        $cart = new ShoppingCart($expectedItems);
        $items = $cart->items();

        foreach ($expectedItems as $expectedItem) {
            $this->assertContains($expectedItem, $items);
        }
    }
}
