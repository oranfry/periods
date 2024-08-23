<?php

namespace Periods;

use Periods\Period;

class Chunk
{
    protected string $end;
    protected string $id;
    protected string $label;
    protected Period $period;
    protected string $start;

    public function __construct(Period $period, string $start, string $end, string $id, string $label)
    {
        Period::validateDate($start);
        Period::validateDate($end);

        $this->end = $end;
        $this->id = $id;
        $this->label = $label;
        $this->period = $period;
        $this->start = $start;
    }

    public function end(): string
    {
        return $this->end;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function next()
    {
        $start = Period::dateShift($this->end, '+1 day');

        return $this->period->chunk($start);
    }

    public function offset(int $num)
    {
        $chunk = $this;

        for ($i = $num; $i < abs($num); $i++) {
            $chunk = match (true) {
                $num > 0 => $chunk->next(),
                default => $chunk->prev(),
            };
        }

        return $chunk;
    }

    public function period()
    {
        return $period;
    }

    public function prev()
    {
        $end = Period::dateShift($this->start, '-1 day');

        return $this->period->chunk($end);
    }

    public function start(): string
    {
        return $this->start;
    }
}
