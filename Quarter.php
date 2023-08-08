<?php

namespace Periods;

class Quarter extends Period
{
    protected int $offset = 0; // -3 ~ +3

    public function _chunkID(?string $from, ?string $to): string
    {
        extract($this->breakdown($from));

        return "$y-$q";
    }

    public function _chunkLabel(?string $from, ?string $to): string
    {
        extract($this->breakdown($from));

        return "Q{$q} {$y}";
    }

    protected function _end(string $date): ?string
    {
        return static::dateShift($this->_start($date), '+3 months -1 day');
    }

    private function breakdown(string $date)
    {
        // zero-base quarter (0, 1, 2, or 3)

        $q0 = (floor(intval(date('n', strtotime($date))) / 3) - $this->offset + 4) % 4;

        // year

        $y = date('Y', strtotime($date));

        if ($q0 + $this->offset < 0) {
            $y += 1;
        }
        elseif ($q0 + $this->offset > 3) {
            $y -= 1;
        }

        $q = $q0 + 1;

        return compact('q', 'y');
    }

    protected function _start(string $date): ?string
    {
        $q = ceil(intval(date('n', strtotime($date))) / 3);
        $m = str_pad((string) ($q * 3 - 2), 2, '0', STR_PAD_LEFT);

        return date("Y-$m-01", strtotime($date));
    }

    public function label(): string
    {
        return 'Quarter';
    }
}
