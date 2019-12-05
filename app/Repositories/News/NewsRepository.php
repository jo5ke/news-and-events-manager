<?php

namespace App\Repositories\News;

interface NewsRepository
{
    /**
     * {@inheritdoc}
     */
    public function all();

    /**
     * {@inheritdoc}
     */
    public function find($id);

    /**
     * {@inheritdoc}
     */
    public function create(array $data);

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data);

    /**
     * {@inheritdoc}
     */
    public function delete($id);

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null);

    /**
     * {@inheritdoc}
     */
    public function count();
}
