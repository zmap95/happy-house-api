<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseTypeRepository;
use App\Entities\HouseType;
use App\Validators\HouseTypeValidator;

/**
 * Class HouseTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseTypeRepositoryEloquent extends BaseRepository implements HouseTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HouseType::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
