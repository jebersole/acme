<?php

namespace App\DeliveryRules;

// This rule applies a delivery cost of $2.95 for baskets where the total is >= $50.00 and < $90.00
class GreaterThan50Rule extends DeliveryRule
{
    protected float $min = 50.00;
    protected float $max = 90.00;
    protected float $deliveryCost = 2.95;

    public function isApplicableTo(float $total): bool
    {
        return $total >= $this->min && $total < $this->max;
    }
}
