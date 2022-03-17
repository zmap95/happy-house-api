<?php

namespace App\Services;

use App\Repositories\HouseAmenityRepository;
use App\Repositories\HouseRepository;
use App\Repositories\HouseRuleRepository;
use App\Repositories\HouseUtilityRepository;
use App\Repositories\HouseUtilityRepositoryEloquent;

class HouseService extends BaseService
{
    public function __construct(HouseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByUser(int $userId, array $searchCondition = [], array $with = []) {
        return $this->repository->getByUser($userId, $searchCondition, $with);
    }
    public function create(array $data)
    {
        $utilities = $data['utilities'];
        $rules = $data['rules'];
        unset($data['utilities']);
        unset($data['rules']);
        $data['user_id'] = auth()->user()->id;
        $house = $this->repository->create($data);
        $data_utilities = array();
        $data_rules = array();
        $utilitiesRepository = app(HouseAmenityRepository::class);
        foreach ($utilities as $k =>$v){
            $v['house_id'] = $house->id;
            $data_utilities[$k] = $utilitiesRepository->create($v);
        }
        $rulesRepository = app(HouseRuleRepository::class);
        foreach ($rules as $k =>$v){
            $v['house_id'] = $house->id;
            $data_rules[$k] = $rulesRepository->create($v);
        }
        return [
            'house' => $house,
            'utilities' => $data_utilities,
            'rules' => $data_rules
        ];
    }
}
