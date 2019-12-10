<?php


namespace App\Listeners;

use App\Events\News\NewsEvent;
use App\Mail\NewsPublishedMail;
use App\Models\News;
use App\Repositories\News\NewsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class NewsSendNotification implements ShouldQueue
{
    /**
     * Create the event listener
     *
     * @param News $news
     * @return void
     */
    public function __construct(News $news)
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
        $news = $event->getNews();

        Mail::to('user@example.com')->queue(new NewsPublishedMail($news));
    }
}
