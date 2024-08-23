<?php

namespace Periods;

class QuarterMinus3 extends Quarter
{
    public function __construct()
    {
        $this->offset = -3;
    }
}
