<?php

namespace App\Repository\Eloquent;

use App\Models\Reactions;
use App\Repository\ReactionRepositoryInterface;

class ReactionRepository extends BaseRepository implements ReactionRepositoryInterface
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
    public function __construct(Reactions $model)
    {
        $this->model = $model;
    }
}