<?php

namespace Periods;

class Year extends Period
{
    public function _chunkID(?string $from, ?string $to): string
    {
        return date('Y', strtotime($from));
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        return $this->_chunkID($from, $to);
    }

    protected function _end(string $date): ?string
    {
        return date('Y-12-31', strtotime($date));
    }

    protected function _start(string $date): ?string
    {
        return date('Y-01-01', strtotime($date));
    }

    public function label(): string
    {
        return 'Year';
    }
}
