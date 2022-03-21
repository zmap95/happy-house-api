<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseRuleRepository;
use App\Entities\HouseRule;
use App\Validators\HouseRuleValidator;

/**
 * Class HouseRuleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseRuleRepositoryEloquent extends BaseRepository implements HouseRuleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HouseRule::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
