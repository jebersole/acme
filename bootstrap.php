<?php

use DI\ContainerBuilder;
use App\Baskets\Basket;
use App\Catalogs\Catalog;
use App\DeliveryRules\DeliveryRules;
use App\Offers\Offers;

require_once __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    Catalog::class => DI\create(Catalog::class)
        ->constructor([
            DI\get('App\Widgets\GreenWidget'),
            DI\get('App\Widgets\RedWidget'),
            DI\get('App\Widgets\BlueWidget'),
        ]),
    DeliveryRules::class => DI\create(DeliveryRules::class)
        ->constructor([
            DI\get('App\DeliveryRules\GreaterThan50Rule'),
            DI\get('App\DeliveryRules\GreaterThan90Rule'),
            DI\get('App\DeliveryRules\LessThan50Rule'),
        ]),
    Offers::class => DI\create(Offers::class)
        ->constructor([
            DI\get('App\Offers\RedHalfPriceOffer'),
        ]),
    Basket::class => DI\autowire(Basket::class),
]);

$container = $containerBuilder->build();

return $container;
