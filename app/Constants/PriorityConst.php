<?php

namespace App\Constants;

class PriorityConst
{
    const LOW = 1;

    const MEDIUM = 2;

    const HIGH = 3;
    public static function getList()
    {
        return [
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        ];
    }
}
