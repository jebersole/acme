<?php

namespace App\DeliveryRules;

class DeliveryRules
{
    private array $rules = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function calculateDelivery(float $total): float
    {
        foreach ($this->rules as $rule) {
            if ($rule->match($total)) {
                return $rule->getCost();
            }
        }

        throw new \InvalidArgumentException("No rule matching delivery found.");
    }
}
