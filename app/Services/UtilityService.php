<?php

namespace App\Services;

use App\Repositories\UtilityRepository;

class UtilityService extends BaseService
{
    public function __construct(UtilityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->all();
    }
}
