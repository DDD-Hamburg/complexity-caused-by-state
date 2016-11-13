<?php

declare(strict_types=1);

namespace DDDHH;

require __DIR__ . '/../vendor/autoload.php';

use DDDHH\Shop\ShoppingCart;
use DDDHH\Shop\ShoppingCart\Item;
use DDDHH\Shop\CalculatorService;

$calc = new CalculatorService();
$cart = new ShoppingCart();

$itemA = new Item(
    'AAXX-4711',
    'Working Effectively with Legacy Code',
    47.95,
    1
);

$itemB = new Item(
    'BBZZ-0815',
    'Domain-Driven Design: Tackling Complexity in the Heart of Software',
    54.95,
    2
);

$cart->addItem($itemA);
$cart->addItem($itemB);

assert(
    157.85 == round($calc->total($cart), 2),
    'Error calculating total without discounts.'
);

$discount = 0.9;
$discountedItemIds = ['AAXX-4711'];

assert(
    142.07 == round($calc->total($cart, $discount, $discountedItemIds), 2),
    'Error calculating discounted total.'
);

$cart->removeItem($itemA);

assert(
    109.19 == round($calc->total($cart, $discount, $discountedItemIds), 2),
    'Error calculating discounted total.'
);
