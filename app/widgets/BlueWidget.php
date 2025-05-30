<?php

namespace App\Widgets;

class BlueWidget extends Widget
{
    public function __construct()
    {
        $this->price = 7.95;
        $this->code = 'B01';
        parent::__construct();
    }
}
