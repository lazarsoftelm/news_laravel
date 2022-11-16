<?php

namespace App\Repository\Eloquent;

use App\Models\Comments;
use App\Models\Emoji;
use App\Repository\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
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
    public function __construct(Comments $model)
    {
        $this->model = $model;
    }
}