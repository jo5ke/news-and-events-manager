<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use App\Support\Enum\NewsStatus;
use Carbon\Carbon;

class News extends AbstractModel
{
    protected $table = 'news__news';

    protected $dates = ['published_at', 'event_ended_at', 'event_ended_at'];

//    protected $guarded = ['id', 'category_id'];

    /**
     * Scope a query to only include news ready for publishing.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForPublishing($query)
    {
        return $query->where('status', NewsStatus::SCHEDULED)
                ->where('published_at', '<=', Carbon::now());
    }
}
