<?php

namespace App\Services;

use App\Repositories\HouseAmenityRepository;

class HouseAmenityService extends BaseService
{
    public function __construct(HouseAmenityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findByHouse($houseId) {
        return $this->repository->findByField('house_id', $houseId, ['id', 'name', 'icon', 'is_common']);
    }
}
