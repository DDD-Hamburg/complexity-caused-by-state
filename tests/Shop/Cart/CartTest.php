<?php

namespace DDDHH\Shop\Cart;

use DDDHH\Shop\Customer;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldAddRetrieveAndDeleteItem()
    {
        $cart = new Cart(new Customer\Id('XXSS-1234'));

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

        $cart = new Cart(new Customer\Id('XXSS-1234'), $expectedItems);
        $items = $cart->items();

        foreach ($expectedItems as $expectedItem) {
            $this->assertContains($expectedItem, $items);
        }
    }

    /**
     * @test
     */
    public function itShouldInitializeWithId()
    {
        $customerId = new Customer\Id('BBCC-8342');
        $cart = new Cart($customerId);

        $this->assertEquals($customerId, $cart->customerId());
    }
}
