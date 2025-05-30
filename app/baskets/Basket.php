<?php

namespace App\Baskets;

use App\Catalogs\Catalog;
use App\DeliveryRules\DeliveryRules;
use App\Offers\Offers;

class Basket
{
    protected Catalog $catalog;
    protected DeliveryRules $deliveryRules;
    protected Offers $offers;
    protected array $products = [];

    public function __construct(Catalog $catalog, DeliveryRules $deliveryRules, Offers $offers)
    {
        $this->catalog = $catalog;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function addProductByCode(string $productCode): void
    {
        $this->products[] = $this->catalog->createProductByCode($productCode);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotalPrice(): float
    {
        $productTotal = $this->offers->applyOffers($this->products);
        $deliveryTotal = $this->deliveryRules->calculateDelivery($productTotal);

        return round($deliveryTotal + $productTotal, 2, PHP_ROUND_HALF_ODD);
    }
}
