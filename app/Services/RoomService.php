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
        $utilities      = $data->pull('amenities', []);
        $newUtilities   = $data->pull('newAmenities', []);
        $roomPictures   = $data->pull('room_pictures', []);
        $houseId        = $data->get('house_id');
        $data           = $data->toArray();
        $model          = $this->repository->create($data);
        $utilities      = array_merge($utilities, $newUtilities);
        $roomAmenities  = [];
        if (!empty($utilities)) {

            $roomAmenityRepository  = app(RoomAmenityRepository::class);
            $roomAmenitiesOk = [];
            foreach ($utilities as $key => $utility) {
                $roomAmenitiesOk[$key]['room_id'] = $model->id;
                $roomAmenitiesOk[$key]['name'] = $utility['name'];
                $roomAmenitiesOk[$key]['icon'] = $utility['icon'];
            }
            $roomAmenities = $roomAmenityRepository->createMany($model, $roomAmenitiesOk, 'amenities');
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
            'utilities' => $roomAmenities,
            'roomImage' => $roomImageResult
        ];

    }

    public function update(array $data, int $id)
    {
        $data           = collect($data);
        $userId         = \auth()->user()->id;
        $data->put('user_id', $userId);
        $utilities      = $data->pull('amenities', []);
        $newUtilities   = $data->pull('newAmenities', []);
        $roomPictures   = $data->pull('room_pictures', []);
        $houseId        = $data->get('house_id');
        $data           = $data->toArray();
        $model          = $this->repository->update($data, $id);

        $roomAmenityRepository = app(RoomAmenityRepository::class);
        $oldRoomAmenity = $roomAmenityRepository->findWhere(['room_id' => $id])->pluck('id');
        $utilitieIds   = array_column($utilities, 'id');
        $utilities      = array_merge($utilities, $newUtilities);
        $roomAmenities = [];
        if (!empty($utilities)) {

            $utilitiesOk = [];
            $roomUtilityDel = $oldRoomAmenity->diff($utilitieIds)->push(0)->toArray();
            $roomAmenityRepository->deleteWhere([['id', 'IN', [$roomUtilityDel]]]);
            foreach ($utilities as $key => $utility) {

                if (!isset($utility['id'])) {
                    $utilitiesOk['room_id'] = $id;
                    $utilitiesOk['name'] = $utility['name'];
                    $utilitiesOk['icon'] = $utility['icon'];
                    $roomAmenities[] = $roomAmenityRepository->create($utilitiesOk);
                }else{
                    if (!in_array($utility['id'], $utilitieIds)) {
                        $utilitiesOk['room_id'] = $id;
                        $utilitiesOk['name'] = $utility['name'];
                        $utilitiesOk['icon'] = $utility['icon'];
                        $roomAmenities[] = $roomAmenityRepository->create($utilitiesOk);
                    }
                }

            }

        }else {
            $roomAmenityRepository->deleteWhere( ['room_id' => $id]);
        }

        $roomPictureRepository  = app(RoomPictureRepository::class);
        $oldPicture = $roomPictureRepository->findWhere(['room_id' => $id])->pluck('image');
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
            'affected' => $model,
            'utilities' => $roomAmenities,
            'roomImage' => $roomImageResult
        ];
    }
}
