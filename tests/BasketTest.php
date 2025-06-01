<?php

namespace Tests;

use DI\Container;
use PHPUnit\Framework\TestCase;
use App\Baskets\Basket;
use App\Widgets\GreenWidget;
use App\Widgets\RedWidget;
use App\Widgets\BlueWidget;

class BasketTest extends TestCase
{
    /**
     * @var Basket $basket
     */
    protected $basket;
    protected const FULL_COST_DELIVERY = 4.95;
    protected const LOW_COST_DELIVERY = 2.95;

    protected function setUp(): void
    {
        /** @var Container $container */
        $container = require __DIR__ . '/../bootstrap.php';

        // Resolve the Basket class with its dependencies
        $this->basket = $container->get(Basket::class);
    }

    public function testAddProductByCode(): void
    {
        $widget = new GreenWidget();
        $this->basket->addProductByCode($widget->getCode());
        $this->assertCount(1, $this->basket->getProducts());
        $this->assertEquals(round($widget->getPrice() + self::FULL_COST_DELIVERY, 2), $this->basket->getTotalPrice());
    }

    public function testGetTotalPriceWithOffer(): void
    {
        // Buy one RedWidget, get the second one at half price
        $widget = new RedWidget();
        $this->basket->addProductByCode($widget->getCode());
        $this->basket->addProductByCode($widget->getCode());

        $this->assertEquals(round($widget->getPrice() + ($widget->getPrice() / 2) + self::FULL_COST_DELIVERY, 2, PHP_ROUND_HALF_ODD), $this->basket->getTotalPrice());
    }

    public function testLowCostDelivery(): void
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

    public function testFreeDelivery(): void
    {
        $widget = new GreenWidget();
        for ($i = 0; $i < 4; $i++) {
            $this->basket->addProductByCode($widget->getCode());
        }
        $products = $this->basket->getProducts();
        $this->assertCount(4, $products);
        $this->assertEquals(round(4 * $widget->getPrice(), 2, PHP_ROUND_HALF_ODD), $this->basket->getTotalPrice());
    }

    public function testBlueAndGreenBasket(): void
    {
        $this->basket->addProductByCode((new BlueWidget())->getCode());
        $this->basket->addProductByCode((new GreenWidget())->getCode());
        $this->assertEquals(37.85, $this->basket->getTotalPrice());
    }

    public function testRedAndGreenBasket(): void
    {
        $this->basket->addProductByCode((new RedWidget())->getCode());
        $this->basket->addProductByCode((new GreenWidget())->getCode());
        $this->assertEquals(60.85, $this->basket->getTotalPrice());
    }

    public function testBlueAndRedBasket(): void
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
