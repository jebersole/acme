<?php

namespace App\Offers;

interface Offer
{
    public function isApplicableTo(array $products): bool;
    public function apply(array $products): array;
}
