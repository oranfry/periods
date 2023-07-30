<?php

namespace Periods;

class NzFinancialYear extends Period
{
    public function _chunkID(?string $from, ?string $to): string
    {
        return date('Y', strtotime($to));
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        return date('Y', strtotime($to)) . " Financial Year";
    }

    protected function _end(string $date): ?string
    {
        return static::dateShift($this->_start($date), '+1 year -1 day');
    }

    protected function _start(string $date): ?string
    {
        return date('Y-04-01', strtotime(date_shift($date, '-3 month')));
    }

    public function label(): string
    {
        return 'Financial Year';
    }
}
