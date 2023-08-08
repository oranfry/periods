<?php

namespace Periods;

class QuarterPlus3 extends Quarter
{
    public function __construct()
    {
        $this->offset = 3;
    }
}
