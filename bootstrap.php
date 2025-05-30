<?php

use DI\ContainerBuilder;
use App\Baskets\Basket;
use App\Catalogs\WidgetCatalog;
use App\DeliveryRules\DeliveryRules;
use App\Offers\Offers;

require_once __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Define bindings for your dependencies
$containerBuilder->addDefinitions([
    WidgetCatalog::class => DI\create(WidgetCatalog::class),
    DeliveryRules::class => DI\create(DeliveryRules::class),
    Offers::class => DI\create(Offers::class),
    Basket::class => DI\autowire(Basket::class),
]);

$container = $containerBuilder->build();

return $container;
