<?php

namespace App\DeliveryRules;

// This rule grants free delivery for baskets with a total greater than $90.00
class GreaterThan90Rule extends DeliveryRule
{
    protected float $min = 90.00;
    protected float $max = INF; // No upper limit for this rule
    protected float $deliveryCost = 0.00;

    public function isApplicableTo(float $total): bool
    {
        return $total >= $this->min;
    }
}
