<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseRepository;
use App\Entities\House;
use App\Validators\HouseValidator;

/**
 * Class HouseRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseRepositoryEloquent extends BaseRepository implements HouseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return House::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
