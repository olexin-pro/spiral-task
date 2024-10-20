<?php

namespace App\Support\Enums;
enum TaskStatus: string
{
    case New = 'new';
    case Viewed = 'viewed';
    case InWork = 'in_work';
    case Completed = 'completed';
    case Failed = 'failed';

    public static function typecast(string $value): self
    {
        return self::from($value);
    }
}
