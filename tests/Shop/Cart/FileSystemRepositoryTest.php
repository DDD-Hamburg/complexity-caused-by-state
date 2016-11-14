<?php

namespace DDDHH\Shop\Cart;

use DDDHH\Shop\Customer\Id;

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

        $customerId1 = new Id('AABB-1122');
        $customerId2 = new Id('BBCC-2233');

        $expectedItems = [
            (string) $customerId1 => [
                new Item('AAXX-4711', 'A Book', 1.99, 1),
                new Item('BBZZ-3731', 'Another Book', 3.99, 2),
                new Item('CCYY-4115', 'Yet another Book', 13.99, 3),
            ],
            (string) $customerId2 => [
                new Item('XAXX-2711', 'A Book', 1.99, 1),
                new Item('BXZZ-3231', 'Another Book', 3.99, 2),
                new Item('CCYX-4112', 'Yet another Book', 13.99, 3),
            ]
        ];

        $cart1 = new Cart(
            $customerId1,
            $expectedItems[$customerId1->id()]
        );

        $cart2 = new Cart(
            $customerId2,
            $expectedItems[$customerId2->id()]
        );

        $repo->save($cart1);
        $repo->save($cart2);

        $unserializedCart1 = unserialize(
            file_get_contents(join('/', [ self::STORAGE_PATH, $customerId1 ]))
        );

        $unserializedCart2 = unserialize(
            file_get_contents(join('/', [ self::STORAGE_PATH, $customerId2 ]))
        );

        // The customer's shopping carts are successfully stored
        $this->assertEquals($customerId1, $unserializedCart1->customerId());
        $this->assertEquals($customerId2, $unserializedCart2->customerId());

        $expectedItemIds1 = $this->itemIds($expectedItems[(string) $customerId1]);
        $returnedItemIds1 = $this->itemIds($unserializedCart1->items());

        foreach ($expectedItemIds1 as $expectedItemId) {
            $this->assertContains($expectedItemId, $returnedItemIds1);
        }

        $expectedItemIds2 = $this->itemIds($expectedItems[(string) $customerId2]);
        $returnedItemIds2 = $this->itemIds($unserializedCart2->items());

        // The shopping cart's items are successfully stored either
        foreach ($expectedItemIds2 as $expectedItemId) {
            $this->assertContains($expectedItemId, $returnedItemIds2);
        }
    }

    /**
     * @test
     */
    public function itShouldFindById()
    {
        $customerId = new Id('AABB-1122');
        $items = [
            new Item('AAXX-4711', 'A Book', 1.99, 1),
            new Item('BBZZ-3731', 'Another Book', 3.99, 2),
            new Item('CCYY-4115', 'Yet another Book', 13.99, 3),
        ];
        $cart = new Cart(
            $customerId,
            $items
        );

        file_put_contents(
            join('/', [ self::STORAGE_PATH, $customerId ]),
            serialize($cart)
        );

        $repo = new FileSystemRepository(self::STORAGE_PATH);

        $foundCart = $repo->findById($customerId);

        $expectedItemIds = $this->itemIds($items);
        $foundItemIds = $this->itemIds($foundCart->items());

        foreach ($expectedItemIds as $expectedItemId) {
            $this->assertContains($expectedItemId, $foundItemIds);
        }
    }

    /**
     * @param Item[] $items
     * @return string[]
     */
    private function itemIds(array $items): array
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
