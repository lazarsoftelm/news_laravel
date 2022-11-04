<?php

namespace App\Repository\Eloquent;

use App\Models\Categorie;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
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
    public function __construct(Categorie $model)
    {
        $this->model = $model;
    }
}