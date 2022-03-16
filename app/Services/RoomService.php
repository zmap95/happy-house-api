<?php

namespace App\Services;

use App\Repositories\HouseAmenityRepository;
use App\Repositories\HouseRepository;
use App\Repositories\RoomAmenityRepository;
use App\Repositories\RoomPictureRepository;
use App\Repositories\RoomRepository;
use App\Repositories\UtilityRepository;
use Illuminate\Support\Facades\Auth;

class RoomService extends BaseService
{
    private $uploadServive;

    public function __construct(RoomRepository $repository, UploadService $uploadService)
    {
        $this->repository = $repository;
        $this->uploadServive = $uploadService;
    }

    public function create(array $data)
    {
        $data           = collect($data);
        $userId         = \auth()->user()->id;
        $data->put('user_id', $userId);
        $utilities      = $data->pull('utilities', []);
        $newUtilities   = $data->pull('newUtilities', []);
        $roomPictures   = $data->pull('room_pictures', []);
        $houseId        = $data->get('house_id');
        $data           = $data->toArray();
        $model          = $this->repository->create($data);
        $newUtilityIds     = [];

        if (!empty($utilities)) {

            $folder = 'house-' . $houseId;
            $houseAmenityRepository = app(HouseAmenityRepository::class);
            $utilitiesOk = [];
            foreach ($utilities as $key => $utility) {
                $utilitiesOk['house_id'] = $houseId;
                $utilitiesOk['name'] = $utility['name'];
                $utilitiesOk['icon'] = $this->uploadServive->copy($folder, $utility['icon']);
                $newUtilityIds[] = $houseAmenityRepository->updateOrCreate($utilitiesOk)->id;
            }
         }

        if (!empty($newUtilities)) {

            $folder = 'house-' . $houseId;
            $houseAmenityRepository = app(HouseAmenityRepository::class);
            $utilitiesOk = [];
            foreach ($newUtilities as $key => $utility) {
                $utilitiesOk['house_id'] = $houseId;
                $utilitiesOk['name'] = $utility['name'];
                $utilitiesOk['icon'] = $this->uploadServive->realUpload($folder, $utility['icon']);
                $newUtilityIds[] = $houseAmenityRepository->updateOrCreate($utilitiesOk)->id;

            }
        }

        if (!empty($newUtilityIds)) {

            $roomAmenityRepository  = app(RoomAmenityRepository::class);
            $roomAmenities = [];
            foreach ($newUtilityIds as $key => $item) {
                $roomAmenities[$key]['house_utility_id'] = $item;
            }
            $roomAmenityRepository->createMany($model, $roomAmenities, 'amenities');
        }

        $roomImageResult = [];
        if (!empty($roomPictures)) {
            $roomImageOk = [];
            $roomPictureRepository  = app(RoomPictureRepository::class);
            foreach ($roomPictures as $key => $picture) {
                $folder = 'house-' . $houseId . '/' . 'room-' . $model->id;
                $roomImageOk[$key]['image'] = $this->uploadServive->realUpload($folder, $picture);
            }
            $roomImageResult = $roomPictureRepository->createMany($model, $roomImageOk, 'pictures');
        }

        return [
            'room' => $model,
            'utilities' => $newUtilityIds,
            'roomImage' => $roomImageResult
        ];

    }

    public function update(array $data, int $id)
    {
        $data           = collect($data);
        $userId         = \auth()->user()->id;
        $data->put('user_id', $userId);
        $utilities      = $data->pull('utilities', []);
        $newUtilities   = $data->pull('newUtilities', []);
        $roomPictures   = $data->pull('room_pictures', []);
        $houseId        = $data->get('house_id');
        $data           = $data->toArray();
        $model          = $this->repository->update($data, $id);
        $newUtilityIds     = [];

        if (!empty($utilities)) {

            $folder = 'house-' . $houseId;
            $houseAmenityRepository = app(HouseAmenityRepository::class);
            $utilitiesOk = [];

            foreach ($utilities as $key => $utility) {

                $utilitiesOk['house_id'] = $houseId;
                $utilitiesOk['name'] = $utility['name'];
                $utilitiesOk['icon'] = $this->uploadServive->copy($folder, $utility['icon']);
                $newUtilityIds[] = $houseAmenityRepository->updateOrCreate($utilitiesOk)->id;
            }
        }

        if (!empty($newUtilities)) {

            $folder = 'house-' . $houseId;
            $houseAmenityRepository = app(HouseAmenityRepository::class);
            $utilitiesOk = [];
            foreach ($newUtilities as $key => $utility) {
                $utilitiesOk['house_id'] = $houseId;
                $utilitiesOk['name'] = $utility['name'];
                $utilitiesOk['icon'] = $this->uploadServive->realUpload($folder, $utility['icon']);
                $newUtilityIds[] = $houseAmenityRepository->updateOrCreate($utilitiesOk)->id;

            }
        }

        $roomAmenityRepository = app(RoomAmenityRepository::class);
        $oldUtilityId = $roomAmenityRepository->findIdAmenityByRoom($id);

        if (!empty($newUtilityIds)) {

            $utilitiesOk = [];
            $roomUtilityDel = $oldUtilityId->diff($newUtilityIds)->toArray();
            $roomAmenityRepository->deleteWhere([['house_utility_id', 'IN', $roomUtilityDel], ['room_id', '=', $id]]);

            foreach ($newUtilityIds as $key => $utility) {

                $utilitiesOk['room_id'] = $model->id;
                $utilitiesOk['house_utility_id'] = $utility;
                $roomAmenityRepository->updateOrCreate($utilitiesOk);
            }

        }else {
            $roomAmenityRepository->deleteWhere([['house_utility_id', 'IN', $oldUtilityId->toAray()], ['room_id', '=', $id]]);
        }

        $roomPictureRepository  = app(RoomPictureRepository::class);
        $oldPicture = $roomPictureRepository->findPictureByRoom($id);
        $roomImageResult = [];
        if (!empty($roomPictures)) {

            $roomPictureDel = $oldPicture->diff($roomPictures)->toArray();
            $newRoomPicture = collect($roomPictures)->diff($oldPicture)->toArray();
            $roomPictureRepository->deleteWhere([['image', 'IN', $roomPictureDel], ['room_id', '=', $id]]);
            $this->uploadServive->deleleFile($roomPictureDel);
            $folder = 'house-' . $houseId . '/' . 'room-' . $model->id;
            $roomImageOk = [];

            foreach ($newRoomPicture as $key => $picture) {
                $roomImageOk[$key]['image'] = $this->uploadServive->realUpload($folder, $picture);
            }

            $roomImageResult = $roomPictureRepository->createMany($model, $roomImageOk, 'pictures');

        }else{

            $roomPictureRepository->deleteWhere([['image', 'IN', $oldPicture->toArray()], ['room_id', '=', $id]]);
            $this->uploadServive->deleleFile($oldPicture->toArray());
        }

        return [
            'room' => $model,
            'utilities' => $newUtilityIds,
            'roomImage' => $roomImageResult
        ];
    }
}
