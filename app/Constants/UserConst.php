<?php

namespace App\Constants;

class UserConst
{
    const ADMIN = 1;

    const STUDENT = 2;

    const TOOLSMAN = 3;
        
    public static function getAccessTypes()
    {
        return [
            self::ADMIN => 'Admin',
            self::STUDENT => 'Student',
            self::TOOLSMAN => 'toolsman',
        ];
    }
}
