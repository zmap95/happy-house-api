<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface BaseRepository extends RepositoryInterface
{
    public function findWhere(array $where, $columns = ['*'], $with = []);
    public function findFirst(array $where, $columns = ['*'], $with = []);
    public function createMany(Model $model, array $data, $relation);
    public function paginate($limit = null, $columns = ['*'], $where = []);
}
