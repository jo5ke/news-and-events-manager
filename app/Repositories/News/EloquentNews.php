<?php

namespace App\Repositories\News;

use Cache;
use App\Models\News;

class EloquentNews implements NewsRepository
{

    /** @var NewsRepository */
    private $news;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return News::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return News::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $this->news = News::create($data);

        return $this->news;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $this->news = $this->find($id);

        $this->news->update($data);

        Cache::flush();

        return $this->news;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $this->news = $this->find($id);

        $status = $this->news->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null)
    {
        $query = News::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('id', "like", "%{$search}%")
                    ->orWhere('description', "like", "%{$search}%")
                    ->orWhere('title', "like", "%{$search}%");
            });
        }

        $result = $query->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return News::count();
    }
}
