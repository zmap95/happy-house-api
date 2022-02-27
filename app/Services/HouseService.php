<?php

namespace App\Services;


use App\Repositories\HouseRepository;

class HouseService extends BaseService
{
    public function __construct(HouseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByUser(int $userId, array $searchCondition = [], array $with = []) {
        return $this->repository->getByUser($userId, $searchCondition, $with);
    }
}
