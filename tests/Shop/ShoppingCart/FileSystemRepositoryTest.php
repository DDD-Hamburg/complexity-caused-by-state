<?php

namespace DDDHH\Shop\ShoppingCart;

use DDDHH\Shop\ShoppingCart;
use DDDHH\Shop\CustomerID;

use PHPUnit\Framework\TestCase;

class FileSystemRepositoryTest extends TestCase
{
    const STORAGE_PATH = __DIR__ . '/storage';

    /**
     * @test
     */
    public function itShouldSaveAShoppingCart()
    {
        $repo = new FileSystemRepository(self::STORAGE_PATH);

        $customerID1 = new CustomerID('AABB-1122');
        $customerID2 = new CustomerID('BBCC-2233');

        $expectedItems = [
            (string) $customerID1 => [
                new Item('AAXX-4711', 'A Book', 1.99, 1),
                new Item('BBZZ-3731', 'Another Book', 3.99, 2),
                new Item('CCYY-4115', 'Yet another Book', 13.99, 3),
            ],
            (string) $customerID2 => [
                new Item('XAXX-2711', 'A Book', 1.99, 1),
                new Item('BXZZ-3231', 'Another Book', 3.99, 2),
                new Item('CCYX-4112', 'Yet another Book', 13.99, 3),
            ]
        ];

        $cart1 = new ShoppingCart(
            $customerID1,
            $expectedItems[$customerID1->id()]
        );

        $cart2 = new ShoppingCart(
            $customerID2,
            $expectedItems[$customerID2->id()]
        );

        $repo->save($cart1);
        $repo->save($cart2);

        $unserializedCart1 = unserialize(
            file_get_contents(join('/', [ self::STORAGE_PATH, $customerID1 ]))
        );

        $unserializedCart2 = unserialize(
            file_get_contents(join('/', [ self::STORAGE_PATH, $customerID2 ]))
        );

        // The customer's shopping carts are successfully stored
        $this->assertEquals($customerID1, $unserializedCart1->customerID());
        $this->assertEquals($customerID2, $unserializedCart2->customerID());

        $expectedItemIds1 = $this->itemIDs($expectedItems[(string) $customerID1]);
        $returnedItemIds1 = $this->itemIDs($unserializedCart1->items());

        foreach ($expectedItemIds1 as $expectedItemId) {
            $this->assertContains($expectedItemId, $returnedItemIds1);
        }

        $expectedItemIds2 = $this->itemIDs($expectedItems[(string) $customerID2]);
        $returnedItemIds2 = $this->itemIDs($unserializedCart2->items());

        // The shopping cart's items are successfully stored either
        foreach ($expectedItemIds2 as $expectedItemId) {
            $this->assertContains($expectedItemId, $returnedItemIds2);
        }
    }

    /**
     * @param Item[] $items
     * @return string[]
     */
    private function itemIDs(array $items): array
    {
        return array_map(function ($item) {
            return $item->id();
        }, $items);
    }

    public static function setUpBeforeClass()
    {
        if (!file_exists(self::STORAGE_PATH)) {
            mkdir(self::STORAGE_PATH);
        }
    }

    public static function tearDownAfterClass()
    {
        if (file_exists(self::STORAGE_PATH)) {
            rmdir(self::STORAGE_PATH);
        }
    }

    protected function tearDown()
    {
        foreach (scandir(self::STORAGE_PATH) as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            unlink(join('/', [ self::STORAGE_PATH, $file ]));
        }
    }
}
