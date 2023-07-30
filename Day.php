<?php

namespace Periods;

class Day extends Period
{
    public function _chunkID(?string $from, ?string $to): string
    {
        return $from;
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        return $from;
    }

    protected function _end(string $date): ?string
    {
        return $date;
    }

    protected function _start(string $date): ?string
    {
        return $date;
    }

    public function label(): string
    {
        return 'Day';
    }
}
