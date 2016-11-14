<?php

namespace DDDHH\Shop\Cart;

use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldInitialize()
    {
        $id = 'AAXX-4711';
        $description = 'Some Thing';
        $pricePerUnit = 1.99;
        $quantity = 2;

        $item = new Item(
            $id,
            $description,
            $pricePerUnit,
            $quantity
        );

        $this->assertEquals($id, $item->id());
        $this->assertEquals($description, $item->description());
        $this->assertEquals($pricePerUnit, $item->pricePerUnit());
        $this->assertEquals($quantity, $item->quantity());
    }
}
