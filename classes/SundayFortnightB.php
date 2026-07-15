<?php

namespace OranFry\Periods;

class SundayFortnightB extends SundayFortnightBase
{
    protected function chooser(float $rem): bool
    {
        return $rem >= 0.5;
    }
}
