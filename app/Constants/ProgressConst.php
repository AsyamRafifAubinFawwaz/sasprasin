<?php

namespace App\Constants;

class ProgressConst
{
    const PENDING = 1;

    const IN_PROGRESS = 2;

    const DONE = 3;

    public static function getList()
    {
        return [
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::DONE => 'Done',
        ];
    }
}
