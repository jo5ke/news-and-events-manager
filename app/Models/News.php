<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news__news';

    protected $dates = ['published_at', 'event_ended_at', 'event_ended_at'];

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'description',
        'status',
        'post_type',
        'published_at',
        'event_started_at',
        'event_ended_at',
        'post_on',
        'slider_image',
        'featured',
        'poster_image'
    ];
}
