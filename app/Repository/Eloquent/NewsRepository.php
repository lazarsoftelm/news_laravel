<?php

namespace App\Repository\Eloquent;

use App\Models\News;
use App\Repository\NewsRepositoryInterface;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(News $model)
    {
        $this->model = $model;
    }
}