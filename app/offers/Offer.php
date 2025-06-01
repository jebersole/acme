<?php

namespace App\Offers;

use App\Widgets\Widget;

interface Offer
{
    /**
     * @param array<Widget> $products
     */
    public function isApplicableTo(array $products): bool;

    /**
     * @param array<Widget> $products
     * @return array<Widget>
     */
    public function apply(array $products): array;
}
