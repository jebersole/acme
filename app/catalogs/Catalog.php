<?php

namespace App\Catalogs;

use InvalidArgumentException;
use App\Widgets\Widget;

class Catalog
{
    /**
     * @var array<Widget> $products
     */
    protected array $products;

    /**
     * @param array<Widget> $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return array<Widget>
     */
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

        throw new InvalidArgumentException("Product with code $code not found in catalog.");
    }
}
