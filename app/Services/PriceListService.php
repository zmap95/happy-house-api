<?php

namespace App\Services;

use App\Repositories\PriceListRepository;

class PriceListService extends BaseService
{
    public function __construct(PriceListRepository $repository)
    {
        $this->repository = $repository;
    }
}
