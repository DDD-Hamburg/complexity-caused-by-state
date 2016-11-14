<?php

namespace DDDHH\Shop;

use DDDHH\Shop\ShoppingCart\Item;

use PHPUnit\Framework\TestCase;

class ImperativeCalculatorServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCalulateTotal()
    {
        $calc = new ImperativeCalculatorService();

        $cart = new ShoppingCart();
        $cart->addItem(new Item(
            'AAXX-4711',
            'Working Effectively with Legacy Code',
            47.95,
            1
        ));
        $cart->addItem(new Item(
            'BBZZ-0815',
            'Domain-Driven Design: Tackling Complexity in the Heart of Software',
            54.95,
            2
        ));

        $expectedTotal = 1 * 47.95 + 2 * 54.95;

        $this->assertEquals(
            $expectedTotal,
            $calc->total($cart)
        );
    }

    /**
     * @test
     */
    public function itShouldConsiderDiscounts()
    {
        $calc = new ImperativeCalculatorService();

        $cart = new ShoppingCart();
        $cart->addItem(new Item(
            'AAXX-4711',
            'Working Effectively with Legacy Code',
            47.95,
            1
        ));
        $cart->addItem(new Item(
            'BBZZ-0815',
            'Domain-Driven Design: Tackling Complexity in the Heart of Software',
            54.95,
            2
        ));

        $discountedItemIds = ['AAXX-4711'];
        $discount = 0.9;
        $discountedTotal = $calc->total($cart, $discount, $discountedItemIds);

        $expectedTotal = (1 * 47.95 + 2 * 54.95) * $discount;

        $this->assertEquals(
            $expectedTotal,
            $discountedTotal
        );
    }
}
