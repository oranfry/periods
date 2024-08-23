<?php

namespace Periods;

class QuarterPlus2 extends Quarter
{
    public function __construct()
    {
        $this->offset = 2;
    }
}
