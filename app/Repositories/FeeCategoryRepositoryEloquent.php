<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FeeCategoryRepository;
use App\Entities\FeeCategory;
use App\Validators\FeeCategoryValidator;

/**
 * Class FeeCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FeeCategoryRepositoryEloquent extends BaseRepository implements FeeCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FeeCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
