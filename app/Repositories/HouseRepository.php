<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface HouseRepository.
 *
 * @package namespace App\Repositories;
 */
interface HouseRepository extends RepositoryInterface
{
    public function getByUser(int $userId, array $searchCondition = [], array $with = []);
}
