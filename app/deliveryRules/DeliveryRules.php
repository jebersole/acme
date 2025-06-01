<?php

namespace App\DeliveryRules;

use InvalidArgumentException;

class DeliveryRules
{
    /**
     * @var array<DeliveryRule> $rules
     */
    private array $rules = [];

    /**
     * @param array<DeliveryRule> $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function calculateDelivery(float $total): float
    {
        foreach ($this->rules as $rule) {
            if ($rule->isApplicableTo($total)) {
                return $rule->getCost();
            }
        }

        throw new InvalidArgumentException("No applicable delivery rule found.");
    }
}
