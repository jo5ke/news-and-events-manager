<?php

namespace App\Support\Enum;

class NewsType
{
    const NEWS = 'News';
    const EVENT = 'Event';

    public static function lists()
    {
        return [
            self::NEWS => trans('app.'.self::NEWS),
            self::EVENT => trans('app.'.self::EVENT),
        ];
    }
}
