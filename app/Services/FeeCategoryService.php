<?php

namespace App\Services;

use App\Repositories\FeeCategoryRepository;

class FeeCategoryService extends BaseService
{
    public function __construct(FeeCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFeeCategory() {
        return $this->repository->all();
    }
}
