<?php

namespace App\Support\Enum;

class NewsStatus
{
    const PUBLISHED = 'Published';
    const UNPUBLISHED = 'Unpublished';
    const DRAFT = 'Draft';
    const SCHEDULED = 'Scheduled';

    public static function lists()
    {
        return [
            self::PUBLISHED => trans('app.'.self::PUBLISHED),
            self::UNPUBLISHED => trans('app.'.self::UNPUBLISHED),
            self::DRAFT => trans('app.'. self::DRAFT),
            self::SCHEDULED => trans('app.'. self::SCHEDULED),
        ];
    }
}
