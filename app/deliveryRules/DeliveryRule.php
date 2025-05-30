<?php

namespace App\DeliveryRules;

/**
 * Class DeliveryRule
 * Represents a delivery rule with a cost based on the current basket total.
 * This cost is determined with an operator in relation to the min or max value of the rule,
 * provided the cost falls within the range.
 */
class DeliveryRule
{
    private float $min;
    private float $max;
    private float $deliveryCost;
    private string $operator;

    public function __construct(float $min, float $max, float $deliveryCost, string $operator = '<')
    {
        $this->min = $min;
        $this->max = $max;
        $this->deliveryCost = $deliveryCost;
        $this->operator = $operator;
    }

    public function getCost(): float
    {
        return $this->deliveryCost;
    }

    public function match(float $total): bool
    {
        if ($total < $this->min || $total > $this->max) {
            return false;
        }

        switch ($this->operator) {
            case '<':
                return $total < $this->max;
            case '<=':
                return $total <= $this->max;
            case '>':
                return $total > $this->max;
            case '>=':
                return $total >= $this->min;
            default:
                return false;
        }
    }
}
