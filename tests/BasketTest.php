<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Baskets\Basket;
use App\Widgets\GreenWidget;
use App\Widgets\RedWidget;
use App\Widgets\BlueWidget;

class BasketTest extends TestCase
{
    const FULL_COST_DELIVERY = 4.95;
    const LOW_COST_DELIVERY = 2.95;
    protected $basket;

    protected function setUp(): void
    {
        /** @var \DI\Container $container */
        $container = require __DIR__ . '/../bootstrap.php';

        // Resolve the Basket class with its dependencies
        $this->basket = $container->get(Basket::class);
    }

    public function testAddProductByCode()
    {
        $widget = new GreenWidget();
        $this->basket->addProductByCode($widget->getCode());
        $this->assertCount(1, $this->basket->getProducts());
        $this->assertEquals(round($widget->getPrice() + self::FULL_COST_DELIVERY, 2), $this->basket->getTotalPrice());
    }

    public function testGetTotalPriceWithOffer()
    {
        // Buy one RedWidget, get the second one at half price
        $widget = new RedWidget();
        $this->basket->addProductByCode($widget->getCode());
        $this->basket->addProductByCode($widget->getCode());

        $this->assertEquals(round($widget->getPrice() + ($widget->getPrice() / 2) + self::FULL_COST_DELIVERY, 2, PHP_ROUND_HALF_ODD), $this->basket->getTotalPrice());
    }

    public function testLowCostDelivery()
    {
        $total = 0.0;
        foreach ([new BlueWidget(), new GreenWidget(), new RedWidget()] as $widget) {
            $this->basket->addProductByCode($widget->getCode());
            $total += $widget->getPrice();
        }
        $products = $this->basket->getProducts();
        $this->assertCount(3, $products);
        $this->assertEquals(round($total + self::LOW_COST_DELIVERY, 2, PHP_ROUND_HALF_ODD), $this->basket->getTotalPrice());
    }

    public function testFreeDelivery()
    {
        $widget = new GreenWidget();
        for ($i = 0; $i < 4; $i++) {
            $this->basket->addProductByCode($widget->getCode());
        }
        $products = $this->basket->getProducts();
        $this->assertCount(4, $products);
        $this->assertEquals(round(4 * $widget->getPrice(), 2, PHP_ROUND_HALF_ODD), $this->basket->getTotalPrice());
    }

    public function testBlueAndGreenBasket()
    {
        $this->basket->addProductByCode((new BlueWidget())->getCode());
        $this->basket->addProductByCode((new GreenWidget())->getCode());
        $this->assertEquals(37.85, $this->basket->getTotalPrice());
    }

    public function testRedAndGreenBasket()
    {
        $this->basket->addProductByCode((new RedWidget())->getCode());
        $this->basket->addProductByCode((new GreenWidget())->getCode());
        $this->assertEquals(60.85, $this->basket->getTotalPrice());
    }

    public function testBlueAndRedBasket()
    {
        for ($i = 0; $i < 2; $i++) {
            $this->basket->addProductByCode((new BlueWidget())->getCode());
        }
        for ($i = 0; $i < 3; $i++) {
            $this->basket->addProductByCode((new RedWidget())->getCode());
        }
        $this->assertEquals(98.27, $this->basket->getTotalPrice());
    }
}