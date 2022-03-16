<?php

namespace App\Repositories;

use App\Entities\Room;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoomAmenityRepository;
use App\Entities\RoomAmenity;
use App\Validators\RoomAmenityValidator;

/**
 * Class RoomAmenityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomAmenityRepositoryEloquent extends BaseEloquent implements RoomAmenityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomAmenity::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
