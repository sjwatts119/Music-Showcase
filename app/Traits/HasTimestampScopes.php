<?php

namespace App\Traits;

use DateInterval;
use DateTimeInterface;

trait HasTimestampScopes
{
    protected function modifyDate(DateTimeInterface|DateInterval $date): DateTimeInterface
    {
        if ($date instanceof DateInterval) {
            return now()->sub($date);
        }

        return $date;
    }

    public function scopeBefore($query, DateTimeInterface|DateInterval $date, string $column): void
    {
        $query->where($column, '<=', $this->modifyDate($date));
    }

    public function scopeAfter($query, DateTimeInterface|DateInterval $date, string $column): void
    {
        $query->where($column, '>=', $this->modifyDate($date));
    }

    public function scopeBetween($query, DateTimeInterface $start, DateTimeInterface $end, string $column): void
    {
        $query->whereBetween($column, [$start, $end]);
    }

    public function scopeCreatedBefore($query, DateTimeInterface|DateInterval $date): void
    {
        $query->before($date, 'created_at');
    }

    public function scopeCreatedAfter($query, DateTimeInterface|DateInterval $date): void
    {
        $query->after($date, 'created_at');
    }

    public function scopeCreatedBetween($query, DateTimeInterface $start, DateTimeInterface $end): void
    {
        $query->between($start, $end, 'created_at');
    }
}
