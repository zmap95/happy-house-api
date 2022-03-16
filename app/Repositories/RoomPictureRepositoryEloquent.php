<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoomPictureRepository;
use App\Entities\RoomPicture;
use App\Validators\RoomPictureValidator;

/**
 * Class RoomPictureRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomPictureRepositoryEloquent extends BaseEloquent implements RoomPictureRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomPicture::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findPictureByRoom(int $roomId)
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->where('room_id', $roomId)->pluck('image');

        return $this->parserResult($model);
    }
}
