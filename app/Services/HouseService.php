<?php

namespace App\Services;

use App\Repositories\HouseAmenityRepository;
use App\Repositories\HousePictureRepository;
use App\Repositories\HouseRepository;
use App\Repositories\HouseRuleRepository;

class HouseService extends BaseService
{
    private $uploadService;

    public function __construct(HouseRepository $repository, UploadService $uploadService)
    {
        $this->repository = $repository;
        $this->uploadService = $uploadService;
    }

    public function getByUser(int $userId, array $searchCondition = [], array $with = []) {
        return $this->repository->getByUser($userId, $searchCondition, $with);
    }

    public function create(array $data)
    {
        $utilities = $data['utilities'];
        $rules = $data['rules'];
        $pictures = $data['pictures'];
        unset($data['utilities']);
        unset($data['rules']);
        unset($data['pictures']);
        $data['user_id'] = auth()->user()->id;

        $house = $this->repository->create($data);
        $houseId = $house->id;

        $data_utilities = array();
        $utilitiesRepository = app(HouseAmenityRepository::class);
        foreach ($utilities as $k =>$v){
            $v['house_id'] = $houseId;
            $data_utilities[$k] = $utilitiesRepository->create($v);
        }

        $data_rules = array();
        $rulesRepository = app(HouseRuleRepository::class);
        foreach ($rules as $k =>$v){
            $v['house_id'] = $houseId;
            $data_rules[$k] = $rulesRepository->create($v);
        }

        $data_pictures = array();
        $picturesRepository = app(HousePictureRepository::class);

        foreach ($pictures as $k =>$v){
            $folder = 'house-' . $houseId;
            $v['image'] = $this->uploadService->realUpload($folder, $v['path']);
            $v['house_id'] = $houseId;
            $data_pictures[$k] = $picturesRepository->create($v);
        }

        return [
            'house' => $house,
            'utilities' => $data_utilities,
            'rules' => $data_rules,
            'pictures' => $data_pictures
        ];
    }

    public function update(array $data, int $id)
    {
        $utilities = $data['utilities'];
        $rules = $data['rules'];
        $pictures = $data['pictures'];
        unset($data['utilities']);
        unset($data['rules']);
        unset($data['pictures']);

        $house = $this->repository->update($data, $id);

        $data_utilities = array();
        $utilitiesRepository = app(HouseAmenityRepository::class);
        
        foreach ($utilities as $k =>$v){
            $v['house_id'] = $id;
            $data_utilities[$k] = $utilitiesRepository->update($v);
        }

        $data_rules = array();
        $rulesRepository = app(HouseRuleRepository::class);
        foreach ($rules as $k =>$v){
            $v['house_id'] = $id;
            $data_rules[$k] = $rulesRepository->create($v);
        }

        $data_pictures = array();
        $picturesRepository = app(HousePictureRepository::class);

        foreach ($pictures as $k =>$v){
            $folder = 'house-' . $id;
            $v['image'] = $this->uploadService->realUpload($folder, $v['path']);
            $v['house_id'] = $id;
            $data_pictures[$k] = $picturesRepository->create($v);
        }

        return [
            'house' => $house,
            'utilities' => $data_utilities,
            'rules' => $data_rules,
            'pictures' => $data_pictures
        ];
    }
}
