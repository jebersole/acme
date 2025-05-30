<?php

namespace App\Catalogs;

use App\Widgets\Widget;

class Catalog
{
    protected array $products = [];

    public function getProducts(): array
    {
        return $this->products;
    }

    public function createProductByCode(string $code): Widget
    {
        foreach ($this->products as $product) {
            if ($product->getCode() === $code) {
                return new ($product::class);
            }
        }

        throw new \InvalidArgumentException("Product with code $code not found in catalog.");
    }
}
