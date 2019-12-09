<?php

namespace App\Listeners;

use App\Console\Commands\PublishNews;
use App\Events\News\NewsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\News\NewsPublished;

class NewsEventSubscriber implements ShouldQueue
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
     * @param  NewsEvent  $event
     * @return void
     */
    public function handle(NewsEvent $event)
    {
        //
    }

    public function onPublish(NewsPublished $event)
    {
        $news = $event->getNews();

        //send mail
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = "App\Listeners\NewsEventsSubscriber";

        $events->listen(NewsPublished::class, "{$class}@onPublish");
    }
}
