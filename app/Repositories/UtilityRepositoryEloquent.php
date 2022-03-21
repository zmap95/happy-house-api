<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UtilityRepository;
use App\Entities\Utility;
use App\Validators\UtilityValidator;

/**
 * Class UtilityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UtilityRepositoryEloquent extends BaseRepository implements UtilityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Utility::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
