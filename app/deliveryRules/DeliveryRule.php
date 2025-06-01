<?php

namespace App\DeliveryRules;

use LogicException;

/**
 * Class DeliveryRule
 * Represents a delivery rule with a cost based on the current basket total.
 * This cost is determined with an operator in relation to the min or max value of the rule,
 * provided the cost falls within the range.
 */
abstract class DeliveryRule
{
    protected float $min;
    protected float $max;
    protected float $deliveryCost;

    abstract public function isApplicableTo(float $total): bool;

    final public function __construct()
    {
        if (!isset($this->min, $this->max, $this->deliveryCost)) {
            throw new LogicException("Delivery rule properties must be set.");
        }
    }

    public function getCost(): float
    {
        return $this->deliveryCost;
    }
}
