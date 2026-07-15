<?php

namespace OranFry\Periods;

class QuarterMinus2 extends Quarter
{
    public function __construct()
    {
        $this->offset = -2;
    }
}
