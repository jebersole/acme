<?php

namespace App\DeliveryRules;

// This rule applies a delivery cost of $2.95 for baskets where the total is >= $50.00 and < $90.00
class GreaterThan50Rule extends DeliveryRule
{
    public function __construct()
    {
        parent::__construct(50, 90, 2.95);
    }
}
