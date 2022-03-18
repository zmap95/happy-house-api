<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HousePictureRepository;
use App\Entities\HousePicture;
use App\Validators\HousePictureValidator;

/**
 * Class HousePictureRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HousePictureRepositoryEloquent extends BaseRepository implements HousePictureRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HousePicture::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
