<?php

namespace App\DeliveryRules;

class DeliveryRules
{
    private array $rules = [];

    public function __construct()
    {
        $this->rules = [
            new DeliveryRule(0, 50, 4.95),
            new DeliveryRule(50, 90, 2.95),
            new DeliveryRule(90, INF, 0, '>=')
        ];
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
