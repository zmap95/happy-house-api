<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PriceListRepository;
use App\Entities\PriceList;
use App\Validators\PriceListValidator;

/**
 * Class PriceListRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PriceListRepositoryEloquent extends BaseRepository implements PriceListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PriceList::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
