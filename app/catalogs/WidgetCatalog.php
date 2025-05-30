<?php

namespace App\Catalogs;

use App\Widgets\GreenWidget;
use App\Widgets\RedWidget;
use App\Widgets\BlueWidget;

class WidgetCatalog extends Catalog
{
    public function __construct()
    {
        $this->products = [
            new GreenWidget(),
            new RedWidget(),
            new BlueWidget()
        ];
    }
}
