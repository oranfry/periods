<?php

namespace Periods;

class SundayFortnightA extends SundayFortnightBase
{
    protected function chooser(float $rem): bool
    {
        return $rem < 0.5;
    }
}
