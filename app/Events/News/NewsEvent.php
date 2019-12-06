<?php

namespace App\Events\News;

use App\Models\News;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class NewsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var News */
    protected $news;

    /**
     * Create a new event instance.
     *
     * @param News $news
     * @return void
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * @return News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
