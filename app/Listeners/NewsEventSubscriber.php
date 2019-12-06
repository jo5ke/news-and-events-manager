<?php

namespace App\Listeners;

use App\Events\News\NewsPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewsPublished  $event
     * @return void
     */
    public function handle(NewsPublished $event)
    {
        //
    }
}
