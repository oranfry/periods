<?php

namespace Periods;

class Week extends Period
{
    private static $day = 'Mon';

    public function _chunkId(?string $from, ?string $to): string
    {
        return $from;
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        $m1 = date('M', strtotime($from));
        $m2 = date('M', strtotime($to));

        $y1 = date('Y', strtotime($from));
        $y2 = date('Y', strtotime($to));

        return date('j' . ($m1 != $m2 ? ' M' : '') . ($y1 != $y2 ? ' Y' : ''), strtotime($from)) . " - " . date('j M Y', strtotime($to));
    }

    protected function _end(string $date): ?string
    {
        return static::dateShift($this->_start($date), '+1 week -1 day');
    }

    protected function _start(string $date): ?string
    {
        $date = date('Y-m-d', strtotime(static::dateShift($date, '-6 days')));

        while (date('D', strtotime($date)) != static::$day) {
            $date = static::dateShift($date, '+1 day');
        }

        return $date;
    }

    public function label(): string
    {
        return 'Week';
    }
}
