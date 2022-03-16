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
    public function create(array $data)
    {
        $utilities = $data['utilities'];
        $utilities      = $data->pull('utilities', []);
        var_dump($utilities);die();
        $rules = $data['rules'];
        unset($data['utilities']);
        unset($data['rules']);
        $data['user_id'] = auth()->user()->id;
        var_dump($utilities); die();
        $house = $this->repository->create($data);

        return [
            'house' => $house
        ];
    }
}
