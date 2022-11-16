<?php

namespace App\Repository\Eloquent;

use App\Models\Emoji;
use App\Repository\EmojiRepositoryInterface;

class EmojiRepository extends BaseRepository implements EmojiRepositoryInterface
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
    public function __construct(Emoji $model)
    {
        $this->model = $model;
    }
}