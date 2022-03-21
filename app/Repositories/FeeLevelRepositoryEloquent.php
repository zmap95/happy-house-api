<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FeeLevelRepository;
use App\Entities\FeeLevel;
use App\Validators\FeeLevelValidator;

/**
 * Class FeeLevelRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FeeLevelRepositoryEloquent extends BaseRepository implements FeeLevelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FeeLevel::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
