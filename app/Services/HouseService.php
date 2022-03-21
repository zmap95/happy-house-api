<?php

namespace App\Services;

use App\Entities\HouseAmenity;
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
        $utilities = !empty($data['utilities']) ? $data['utilities'] : array();
        $rules = !empty($data['rules']) ? $data['rules'] : array();
        $pictures = !empty($data['pictures']) ? $data['pictures'] : array();
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
        $utilities = !empty($data['utilities']) ? $data['utilities'] : array();
        $edit_utilities = !empty($data['edit_utilities']) ? $data['edit_utilities'] : array();
        $rules = !empty($data['rules']) ? $data['rules'] : array();
        $edit_rules = !empty($data['edit_rules']) ? $data['edit_rules'] : array();
        $pictures = !empty($data['pictures']) ? $data['pictures'] : array();
        $delete_pictures = !empty($data['delete_pictures']) ? $data['delete_pictures'] : array();

        $data_utilities = array();
        $utilitiesRepository = app(HouseAmenityRepository::class);
        if (!empty($utilities)){
            foreach ($utilities as $k =>$v){
                $v['house_id'] = $id;
                $data_utilities[$k] = $utilitiesRepository->create($v);
            }
        }
        if (!empty($edit_utilities)){
            foreach ($edit_utilities as $k =>$v){
                if ($v['delete'] == 1){
                    $utilitiesRepository->delete($v['id']);
                }else{
                    unset($v['delete']);
                    $data_utilities[$k] = $utilitiesRepository->update($v, $v['id']);
                    $data_utilities[$k]['update'] = 1;
                }
            }
        }
        $data_rules = array();
        $rulesRepository = app(HouseRuleRepository::class);
        if (!empty($rules)){
            foreach ($rules as $k =>$v){
                $v['house_id'] = $id;
                $data_rules[$k] = $rulesRepository->create($v);
            }
        }
        if (!empty($edit_rules)){
            foreach ($edit_rules as $k =>$v){
                if ($v['delete'] == 1){
                    $rulesRepository->delete($v['id']);
                }else{
                    unset($v['delete']);
                    $data_rules[$k] = $rulesRepository->update($v, $v['id']);
                    $data_rules[$k]['update'] = 1;
                }
            }
        }

        $data_pictures = array();
        $picturesRepository = app(HousePictureRepository::class);

        if (!empty($pictures)){
            foreach ($pictures as $k =>$v){
                $folder = 'house-' . $id;
                $v['image'] = $this->uploadService->realUpload($folder, $v['path']);
                $v['house_id'] = $id;
                $data_pictures[$k] = $picturesRepository->create($v);
            }
        }
        if (!empty($delete_pictures)){
            foreach ($delete_pictures as $k =>$v){
                $this->uploadService->deleleFile([$v['path']]);
                $picturesRepository->delete($v['id']);
            }
        }
        unset($data['utilities']);
        unset($data['edit_utilities']);
        unset($data['rules']);
        unset($data['edit_rules']);
        unset($data['pictures']);
        unset($data['delete_pictures']);

        $house = $this->repository->update($data, $id);

        return [
            'house' => $house,
            'utilities' => $data_utilities,
            'rules' => $data_rules,
            'pictures' => $data_pictures
        ];
    }
}
