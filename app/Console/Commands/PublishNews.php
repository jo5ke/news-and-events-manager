<?php

namespace App\Console\Commands;

use App\Events\News\NewsPublished;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Repositories\News\NewsRepository;
use App\Support\Enum\NewsStatus;

class PublishNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all scheduled news';

    /** @var NewsRepository */
    private $news;

    /**
     * Create a new command instance.
     *
     * @param
     * @return void
     */
    public function __construct(NewsRepository $news)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $news = $this->news->all();

//        foreach ($news as $newsItem) {
//            if ($newsItem->published_at->isPast()) {
//                $this->news->update($newsItem->id, ["status" => NewsStatus::PUB]);
//
//                event(new NewsPublished($newsItem));
//            }
//        }

        $news = News::forPublishing()->get();

        foreach ($news as $newsItem) {
            event(new NewsPublished($newsItem));
        }

        //TODO: send mail to user
    }
}
