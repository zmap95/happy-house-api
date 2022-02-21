<?php

namespace App\Repositories;

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
}
