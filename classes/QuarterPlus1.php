<?php

namespace OranFry\Periods;

class QuarterPlus1 extends Quarter
{
    public function __construct()
    {
        $this->offset = 1;
    }
}
