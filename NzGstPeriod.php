<?php

namespace Periods;

class NzGstPeriod extends Period
{
    public function _chunkID(?string $from, ?string $to): string
    {
        $num = match ((int) date('n', strtotime($from))) {
            2 => 6,
            4 => 1,
            6 => 2,
            8 => 3,
            10 => 4,
            12 => 5,
        };

        $fy = date('Y', strtotime($from)) + ($num == 6 ? 0 : 1);

        return "$fy-$num";
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        $y1 = date('Y', strtotime($from));
        $y2 = date('Y', strtotime(date_shift($from, '+1 month')));

        $m1 = date('M', strtotime($from));
        $m2 = date('M', strtotime(date_shift($from, '+1 month')));

        $id = $this->_chunkID($from, $to);

        if ($y1 != $y2) {
            return "$id ($m1 $y1 ~ $m2 $y2)";
        }

        return "$id ($m1 ~ $m2 $y1)";
    }

    protected function _end(string $date): ?string
    {
        return static::dateShift($this->_start($date), '+2 months -1 day');
    }

    protected function _start(string $date): ?string
    {
        $m = sprintf('%02d', (floor(substr($date, 5, 2) / 2) * 2 + 11) % 12 + 1);
        $y = date('Y', strtotime($date)) - ($m > date('m', strtotime($date)) ? 1 : 0);

        return "$y-$m-01";
    }

    public function label(): string
    {
        return 'GST Period';
    }
}
