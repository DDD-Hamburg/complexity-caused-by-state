<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;

use PHPUnit\Framework\TestCase;

class FileSystemRepositoryTest extends TestCase
{
    const STORAGE_FILE = 'file_system_repository_test_storage';

    protected function tearDown()
    {
        if (file_exists(self::STORAGE_FILE)) {
            unlink(self::STORAGE_FILE);
        }
    }

    /**
     * @test
     */
    public function itShouldSaveAShoppingCart()
    {
        $repo = new FileSystemRepository(self::STORAGE_FILE);

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

        $cart = new ShoppingCart();

        foreach ($expectedItems as $item) {
            $cart->addItem($item);
        }

        $repo->save($cart);

        $storageContent = file_get_contents(self::STORAGE_FILE);
        $unserializedShoppingCart = unserialize($storageContent);

        $itemIds = array_map(function ($item) {
            return $item->id();
        }, $unserializedShoppingCart->items());

        foreach ($expectedItems as $expectedItem) {
            $this->assertContains($expectedItem->id(), $itemIds);
        }
    }
}
