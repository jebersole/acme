<?php

namespace App\Offers;

use App\Widgets\Widget;

class Offers
{
    /**
     * @var array<Offer> $offers
     */
    protected array $offers;

    /**
     * @param array<Offer> $offers
     */
    public function __construct(array $offers = [])
    {
        $this->offers = $offers;
    }

    /**
     * @param array<Widget> $products
     */
    public function applyOffers(array $products): float
    {
        foreach ($products as &$product) {
            $product->resetPrice();
        }

        $productsAfterOffers = $products;
        foreach ($this->offers as $offer) {
            if ($offer->isApplicableTo($products)) {
                $productsAfterOffers = $offer->apply($productsAfterOffers);
            }
        }

        $total = 0.0;

        /**
         * @var array<Widget> $productsAfterOffers
         */
        foreach ($productsAfterOffers as $productAfterOffers) {
            $total += $productAfterOffers->getPrice();
        }

        return $total;
    }
}
