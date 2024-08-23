<?php

namespace Periods;

class QuarterMinus1 extends Quarter
{
    public function __construct()
    {
        $this->offset = -1;
    }
}
