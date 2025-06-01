<?php

namespace App\DeliveryRules;

// This rule applies a delivery cost of $4.95 for baskets with a total less than $50.00
class LessThan50Rule extends DeliveryRule
{
    protected float $min = 0.00;
    protected float $max = 50.00;
    protected float $deliveryCost = 4.95;

    public function isApplicableTo(float $total): bool
    {
        return $total < $this->max;
    }
}
