<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\News\NewsRepository;
use App\Support\Enum\{NewsStatus, NewsType};

class NewsController extends Controller
{

    /**
     * @var NewsRepository
     */
    private $news;

    /**
     * NewsController constructor
     * @param NewsRepository $news
     */
    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }

    /**
     * Display a listing of the news.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = $this->news->create($request->all());
        return $news;
    }

    /**
     * Display the specified news.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $news = $this->news->find($news->id);
        return $news;
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $news = $this->news->update($news->id,$request->all());
        return $news;
    }

    /**
     * Remove the specified news from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $status = $this->news->delete($news->id);
        return $status;
    }

}
