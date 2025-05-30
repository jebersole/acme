<?php

namespace App\DeliveryRules;

// This rule applies a delivery cost of $4.95 for baskets with a total less than $50.00
class LessThan50Rule extends DeliveryRule
{
    public function __construct()
    {
        parent::__construct(0, 50, 4.95);
    }
}
