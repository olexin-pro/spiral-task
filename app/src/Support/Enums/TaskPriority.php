<?php

namespace App\Support\Enums;
enum TaskPriority: string
{
    case Low = 'low';
    case Middle = 'middle';
    case High = 'high';

    public static function typecast(string $value): self
    {
        return self::from($value);
    }
}
