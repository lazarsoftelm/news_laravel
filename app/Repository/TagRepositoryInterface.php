<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface TagRepositoryInterface extends EloquentRepositoryInterface 
{
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
    ): ?Model;
}