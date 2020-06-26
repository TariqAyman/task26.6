<?php
// Copyright
declare(strict_types=1);


namespace App\Helpers;

class TaskStatus
{
    const Done = 'done';
    const InProgress = 'in_progress';

    public static function lists()
    {
        return [
            self::Done => trans('app.'.self::Done),
            self::InProgress => trans('app.'. self::InProgress),
        ];
    }
}
