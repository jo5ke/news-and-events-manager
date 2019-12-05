<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Services\Upload\NewsImageManager;
use Illuminate\Support\Facades\Input;
use App\Repositories\News\NewsRepository;
use App\Support\Enum\NewsStatus;
use App\Support\Enum\NewsType;

class NewsController extends Controller
{

    /** @var NewsRepository  */
    private $news;

    /** @var NewsImageManager  */
    private $newsImageManager;

    /**
     * NewsController constructor
     *
     * @param NewsRepository $news
     * @param NewsImageManager $newsImageManager
     */
    public function __construct(NewsRepository $news, NewsImageManager $newsImageManager)
    {
        $this->news = $news;
        $this->newsImageManager = $newsImageManager;
    }

    /**
     * Display a listing of the news.
     *
     * @param int $perPage
     * @param string $search
     *
     * @return mixed
     */
    public function index()
    {
        $news = $this->news->paginate(
            Input::get('perPage'),
            Input::get('search')
        );

        return $news;
    }

    /**
     * Show the form for creating a new news.
     *
     * @return mixed
     */
    public function create()
    {
        $response = [
            'statuses' => NewsStatus::lists(),
            'types' => NewsType::lists(),
        ];

        return $response;
    }

    /**
     * Store a newly created news in storage.
     *
     * @param  \App\Http\Requests\CreateNewsRequest  $request
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function store(CreateNewsRequest $request)
    {
        $news = $this->news->create($request->all());

        $this->newsImageManager->uploadAndCropAvatar($news, $request->file('image'));

        return $news;
    }

    /**
     * Display the specified news.
     *
     * @param  \App\Models\News  $news
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function show(News $news)
    {
        $news = $this->news->find($news->id);

        return $news;
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param  \App\Models\News  $news
     *
     * @return mixed
     */
    public function edit(News $news)
    {
        $response = [
            'news' => $this->news->find($news->id),
            'statuses' => NewsStatus::lists(),
            'types' => NewsType::lists(),
        ];

        return $response;
    }

    /**
     * Update the specified news in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news = $this->news->update($news->id, $request->all());

        $this->newsImageManager->uploadAndCropAvatar($news, $request->file('image'));

        return $news;
    }

    /**
     * Remove the specified news from storage.
     *
     * @param  \App\Models\News  $news
     *
     * @return bool
     */
    public function destroy(News $news)
    {
        $status = $this->news->delete($news->id);

        return $status;
    }
}
