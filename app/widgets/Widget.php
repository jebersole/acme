<?php

namespace App\Widgets;

use LogicException;

class Widget
{
    protected float $originalPrice;
    protected float $price;
    protected string $code;
    protected string $id;

    public function __construct()
    {
        if (!isset($this->price, $this->code)) {
            throw new LogicException("Widget price and code must be set.");
        }
        $this->originalPrice = $this->price;
        $this->id = uniqid();
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function resetPrice(): void
    {
        $this->price = $this->originalPrice;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
