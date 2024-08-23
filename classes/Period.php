<?php

namespace Periods;

use Periods\Chunk;

class Period
{
    public final function chunk(string $date): Chunk
    {
        $start = $this->start($date);
        $end = $this->end($date);
        $id = $this->_chunkId($start, $end);
        $label = $this->_chunkLabel($start, $end);

        return new Chunk($this, $start, $end, $id, $label);
    }

    public final function chunkId(string $date): string
    {
        return $this->_chunkId($this->start($date), $this->end($date));
    }

    protected function _chunkId(?string $from, ?string $to): string
    {
        if ($from === null && $to === null) {
            return 'alltime';
        }

        if ($from === $to) {
            return $from;
        }

        return $from . '~' . $to;
    }

    public final function chunkLabel(string $date): string
    {
        return $this->_chunkLabel($this->start($date), $this->end($date));
    }

    protected function _chunkLabel(?string $from, ?string $to): string
    {
        if ($from === null && $to === null) {
            return 'All Time';
        }

        $to_rendered = date('D j F Y', strtotime($to));

        if ($from === null) {
            return 'Up to and including ' . $to_rendered;
        }

        $from_rendered = date('D j F Y', strtotime($from));

        if ($to === null) {
            return $from_rendered . ' and beyond';
        }

        return $from_rendered . ' - ' . $to_rendered;
    }

    public static function dateShift(string $date, string $offset): string
    {
        static::validateDate($date);

        return date('Y-m-d', strtotime($offset, strtotime($date)));
    }

    public final function end(string $date): ?string
    {
        static::validateDate($date);

        $end = $this->_end($date);

        if ($end !== null) {
            static::validateDate($end);
        }

        return $end;
    }

    protected function _end(string $date): ?string
    {
        return null;
    }

    public final function start($date): ?string
    {
        static::validateDate($date);

        $start = $this->_start($date);

        if ($start !== null) {
            static::validateDate($start);
        }

        return $start;
    }

    protected function _start(string $date): ?string
    {
        return null;
    }

    public function label(): ?string
    {
        return null;
    }

    public static function validateDate(string $date): void
    {
        if (!preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $date, $matches)) {
            throw new Exceptions\InvalidDateException('Invalid format - use YYYY-MM-DD');
        }

        if (!checkdate(intval($matches[2]), intval($matches[3]), intval($matches[1]))) {
            throw new Exceptions\InvalidDateException('No such date');
        }
    }
}
