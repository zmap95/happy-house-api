<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseAmenityRepository;
use App\Entities\HouseAmenity;
use App\Validators\HouseAmenityValidator;

/**
 * Class HouseAmenityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseAmenityRepositoryEloquent extends BaseEloquent implements HouseAmenityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HouseAmenity::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
