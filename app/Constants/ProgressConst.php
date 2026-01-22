<?php

namespace App\Constants;

class ProgressConst
{
    const PENDING = 1;

    const IN_PROGRESS = 2;

    const DONE = 3;

    const REJECT = 4;

    public static function getList()
    {
        return [
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::DONE => 'Done',
            self::REJECT => 'Reject',
        ];
    }
}
