<?php

declare(strict_types=1);

namespace DDDHH;

require __DIR__ . '/../vendor/autoload.php';

use DDDHH\Shop\CalculatorService;
use DDDHH\Shop\Cart\Cart;
use DDDHH\Shop\Customer\Id;
use DDDHH\Shop\Cart\Item;
use DDDHH\Shop\ExternalCalculatorService;
use DDDHH\Shop\FunctionalCalculatorService;
use DDDHH\Shop\BrokenFunctionalCalculatorService;
use DDDHH\Shop\ImperativeCalculatorService;
use GuzzleHttp\Psr7\Request;

$elixirRequest = new Request('POST', 'http://localhost:4000/api/total');
$haskellRequest = new Request(
    'POST', 'http://localhost:3000/cart',
    [ 'Content-Type' => 'application/json', ]
);

/** @var CalculatorService[] $calculators */
$calculators = [
    new ImperativeCalculatorService(),
    new ExternalCalculatorService(
        new Shop\ExternalCalculatorService\GenericPort($elixirRequest), new Shop\ExternalCalculatorService\JsonAdapter()
    ),
    new ExternalCalculatorService(
        new Shop\ExternalCalculatorService\JsonPort($haskellRequest), new Shop\ExternalCalculatorService\JsonAdapter()
    )
];


$discountedItem = new Item('AAXX-4711', 'Working Effectively with Legacy Code', 47.95, 1);
$undiscountedItem = new Item('BBZZ-0815','Domain-Driven Design', 54.95, 2);
$cartComplexityCalculator = new CartComplexityEvaluator($calculators, $undiscountedItem, $discountedItem);
$cartComplexityCalculator->testAll();

class CartComplexityEvaluator
{
    const DISCOUNT = 0.9;

    /** @var CalculatorService[] */
    private $calculators;

    /** @var Item */
    private $undiscountedItem;

    /** @var Item */
    private $discountedItem;

    public function __construct(array $calculators, $undiscountedItem, $discountedItem)
    {
        $this->calculators = $calculators;
        $this->undiscountedItem = $undiscountedItem;
        $this->discountedItem = $discountedItem;
    }

    public function testAll() {
        foreach ($this->calculators as $calculator) {
            echo "\n --------------------------------------------------------------------- \n";
            echo "\n Testing " . get_class($calculator) . "\n";
            echo "\n --------------------------------------------------------------------- \n";
            try {
                $this->itShouldConsiderTotal($calculator);
                $this->itShouldConsiderDiscount($calculator);
                $this->itShouldNotHoldState($calculator);
            } catch (\RuntimeException $ex) {
                $this->error("The service is not active");
            }
        }
    }

    private function itShouldConsiderTotal(CalculatorService $calculatorService)
    {

        echo "add undiscounted item to the cart -> the calculation should be 54.95 x 2 without any discount";
        $cart = $this->generateNewShoppingCart();
        $cart->addItem($this->undiscountedItem);
        $expected = 109.9;
        $actual = round($calculatorService->total($cart, self::DISCOUNT, [$this->discountedItem->id()]), 2);
        $this->assertEqual($expected, $actual, "Error calculating total without discounts");
    }

    private function itShouldConsiderDiscount(CalculatorService $calculatorService)
    {
        echo "add both a discounted and undiscounted item to the cart -> the calculation should be 54.95 x 2 + 47.95 - discount";
        $cart = $this->generateNewShoppingCart();
        $cart->addItem($this->undiscountedItem);
        $cart->addItem($this->discountedItem);
        $expected = 142.07;
        $actual = round($calculatorService->total($cart, self::DISCOUNT, [$this->discountedItem->id()]), 2);
        $this->assertEqual(
            $expected,
            $actual,
            "Error calculating discounted total"
        );
    }

    private function itShouldNotHoldState(CalculatorService $calculatorService)
    {
        echo "add a discounted and undiscounted item. Before calculating the total we remove the discounted item, the result should be undiscounted";
        $cart = $this->generateNewShoppingCart();
        $cart->addItem($this->undiscountedItem);
        $cart->addItem($this->discountedItem);
        round($calculatorService->total($cart, self::DISCOUNT, [$this->discountedItem->id()]), 2);
        $cart->removeItem($this->discountedItem);
        $actual = round($calculatorService->total($cart, self::DISCOUNT, [$this->discountedItem->id()]), 2);
        $expected = 109.9;
        $this->assertEqual(
            $expected,
            $actual,
            "Error calculating undiscounted total with after removing discounted item"
        );
    }

    /**
     * @return Cart
     */
    private function generateNewShoppingCart()
    {
        return new Cart(new Id(uniqid()));
    }

    private function assertEqual($expected, $actual, $errorMessage)
    {
        if ($expected !== $actual) {
            $message = "{$errorMessage} exptected: {$expected} actual: {$actual}";
            $this->error($message);
        } else {
            $this->ok();
        }
    }

    private function error($message)
    {
        echo "\033[01;31m {$message} \e[0m \n";
    }

    private function ok()
    {
        echo "\033[01;32m  .... OK \e[0m \n";
    }
}

