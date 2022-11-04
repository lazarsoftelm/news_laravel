<?php

namespace App\Repository\Eloquent;

use App\Models\Tags;
use App\Repository\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TagRepository extends BaseRepository implements TagRepositoryInterface
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
    public function __construct(Tags $model)
    {
        $this->model = $model;
    }

    /**
     * Find model by name.
     *
     * @param string $modelName
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findByName(
        string $modelName,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->where('name', $modelName)->firstOrFail()->append($appends);
    }
}