<?php

namespace App\DeliveryRules;

// This rule grants free delivery for baskets with a total greater than $90.00
class GreaterThan90Rule extends DeliveryRule
{
    public function __construct()
    {
        parent::__construct(90, INF, 0, '>=');
    }
}
