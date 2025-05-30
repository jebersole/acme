<?php

namespace App\Widgets;

class GreenWidget extends Widget
{
    public function __construct()
    {
        $this->price = 24.95;
        $this->code = 'G01';
        parent::__construct();
    }
}
