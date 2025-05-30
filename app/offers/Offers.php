<?php

namespace App\Offers;

class Offers
{
    protected array $offers;

    public function __construct()
    {
        $this->offers = [
            new RedHalfPriceOffer()
        ];
    }

    public function applyOffers(array $products): float
    {
        foreach ($products as &$product) {
            $product->resetPrice();
        }
        $productsAfterOffers = $products; // Initialize with original products
        foreach ($this->offers as $offer) {
            if ($offer->isApplicableTo($products)) {
                $productsAfterOffers = $offer->apply($productsAfterOffers);
            }
        }

        $total = 0.0;
        foreach ($productsAfterOffers as $productAfterOffers) {
            $total += $productAfterOffers->getPrice();
        }

        return $total;
    }
}
