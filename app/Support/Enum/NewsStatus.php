<?php

namespace App\Support\Enum;

class NewsStatus
{
    const PUB = 'Published';
    const UNPUB = 'Unpublished';
    const DRAFT = 'Draft';
    const SCH = 'Scheduled';

    public static function lists()
    {
        return [
            self::PUB => trans('app.'.self::PUB),
            self::UNPUB => trans('app.'.self::UNPUB),
            self::DRAFT => trans('app.'. self::DRAFT),
            self::SCH => trans('app.'. self::SCH),
        ];
    }
}
