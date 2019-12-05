<?php

namespace App\Transformers;

use App\Models\News;

class NewsTransformer
{
    public function transform(News $news)
    {
        return [
            'id' => $news->id,
            'title' => $news->title,
            'image' => $news->image,
            'description' => $news->description,
            'status' => $news->status,
            'post_type' => $news->post_type,
            'published_at' => date("F d, Y \a\\t h:i A", strtotime($news->published_at)), //change to Carbon
            'event_started_at' => date("F d, Y \a\\t h:i A", strtotime($news->event_started_at)),
            'event_ended_at' => date("F d, Y \a\\t h:i A", strtotime($news->event_ended_at)),
            'slider_image' => $news->slider_image,
            'poster_image' => $news->poster_image,
            'featured' => $news->featured,
        ];
    }
}
