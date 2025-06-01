<?php

namespace App\Offers;

use App\Widgets\Widget;
use App\Widgets\RedWidget;

/**
 * RedHalfPriceOffer class applies a half-price discount to every second RedWidget
 * in the cart, if there are more than one RedWidget present.
 */
class RedHalfPriceOffer implements Offer
{
    public function isApplicableTo(array $products): bool
    {
        $redCount = 0;
        foreach ($products as $product) {
            if ($product instanceof RedWidget) {
                $redCount++;
            }
        }

        return $redCount > 1;
    }

    /**
     * @param array<Widget> $products
     */
    public function apply(array $products): array
    {
        $seenRed = false;
        foreach ($products as $product) {
            if ($product instanceof RedWidget) {
                if ($seenRed) {
                    $product->setPrice($product->getPrice() / 2);
                    $seenRed = false;
                    continue;
                }
                $seenRed = true;
            }
        }

        return $products;
    }
}
