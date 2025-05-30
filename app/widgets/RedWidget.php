<?php

namespace App\Widgets;

class RedWidget extends Widget
{
    public function __construct()
    {
        $this->price = 32.95;
        $this->code = 'R01';
        parent::__construct();
    }
}
