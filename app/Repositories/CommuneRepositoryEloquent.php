<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CommuneRepository;
use App\Entities\Commune;
use App\Validators\CommuneValidator;

/**
 * Class CommuneRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommuneRepositoryEloquent extends BaseRepository implements CommuneRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Commune::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
