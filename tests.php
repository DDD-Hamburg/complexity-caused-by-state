<?php
require 'autoload.php';
$serviceContainer = new ServiceContainer();

$shoppingCart = new ShoppingCart();
$shoppingCart->addItem(new Item(1, 'first item', 'IDCODE', 2.25));
$shoppingCart->addItem(new Item(1, 'first item', 'QY25', 3.75));
$shoppingCart->addItem(new Item(1, 'first item', 'ARTID', 4));
$calculatorService = $serviceContainer->getCalculatorService();
//in the hsopping cart we have 2.25 + 3.75 + 4, plus a discount of 10% as the user added item id:QY25
// 6 + 4 = 10 - 10% = 9
$total = $calculatorService->getTotal($shoppingCart);
assert($calculatorService->getTotal($shoppingCart) == 9, 'Error calculating the shopping Cart');
$shoppingCart = $shoppingCart->removeItemByPosition(1);
//after removing the special discounted item with code QY25 the discount of 10% should not be applied anymore
assert($calculatorService->getTotal($shoppingCart) == '6.25', 'Error calculating the shopping Cart. Current: ' . $calculatorService->getTotal($shoppingCart) . ' expected:6.25');



