<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseCategoryRepository;
use App\Entities\HouseCategory;
use App\Validators\HouseCategoryValidator;

/**
 * Class HouseCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseCategoryRepositoryEloquent extends BaseRepository implements HouseCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HouseCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
