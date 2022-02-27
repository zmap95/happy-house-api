<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseUtilityRepository;
use App\Entities\HouseUtility;
use App\Validators\HouseUtilityValidator;

/**
 * Class HouseUtilityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseUtilityRepositoryEloquent extends BaseRepository implements HouseUtilityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HouseUtility::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
