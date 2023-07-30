<?php

namespace Periods;

abstract class SundayFortnightBase extends Period
{
    abstract protected function chooser(float $rem): bool;

    public function _chunkLabel(?string $from, ?string $to): string
    {
        $m1 = date('M', strtotime($from));
        $m2 = date('M', strtotime($to));

        $y1 = date('Y', strtotime($from));
        $y2 = date('Y', strtotime($to));

        return date('j' . ($m1 != $m2 ? ' M' : '') . ($y1 != $y2 ? ' Y' : ''), strtotime($from)) . " - " . date('j M Y', strtotime($to));
    }

    protected function _end($date): ?string
    {
        return static::dateShift($this->start($date), '+13 days');
    }

    protected function _start($date): ?string
    {
        // Go back 13 days
        $raw = date('Y-m-d', strtotime(static::dateShift($date, '-13 days')));

        // Fast-forward to a Sunday
        for (; date('D', strtotime($raw)) != 'Sun'; $raw = static::dateShift($raw, '1 day'));

        $time = strtotime($raw);
        $fortnight_in_s = 1209600;
        $week_in_s = 604800;
        $x = $time / $fortnight_in_s;

        if ($this->chooser($x - floor($x))) {
            $time += $week_in_s;
        }

        return date('Y-m-d', $time);
    }

    public function label(): string
    {
        return 'Sunday Fortnight';
    }
}
