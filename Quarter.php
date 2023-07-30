<?php

namespace Periods;

class Year extends Period
{
    public function _chunkID(?string $from, ?string $to): string
    {
        $q = $this->qnum($from);
        $y = date('Y', strtotime($from));

        return "$y-$q";
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        $q = $this->qnum($from);
        $y = date('Y', strtotime($from));

        return "Q{$q} {$y}";
    }

    protected function _end(string $date): ?string
    {
        return static::dateShift($this->_start($date), '+3 months -1 day');
    }

    private function qnum(string $date)
    {
        return ceil(intval(date('n', strtotime($date))) / 3);
    }

    protected function _start(string $date): ?string
    {
        $m = str_pad((string) ($this->qnum($date) * 3 - 2), 2, '0', STR_PAD_LEFT);

        return date("Y-$m-01", strtotime($date));
    }

    public function label(): string
    {
        return 'Quarter';
    }
}
