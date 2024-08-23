<?php

namespace Periods;

class Month extends Period
{
    public function _chunkID(?string $from, ?string $to): string
    {
        return date('Y-m', strtotime($from));
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        return date('F Y', strtotime($from));
    }

    protected function _end(string $date): ?string
    {
        return static::dateShift($this->_start($date), '+1 month -1 day');
    }

    protected function _start(string $date): ?string
    {
        return date('Y-m-01', strtotime($date));
    }

    public function label(): string
    {
        return 'Month';
    }
}
