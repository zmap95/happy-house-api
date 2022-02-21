<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseEloquent implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByPhoneOrEmail($phoneOrEmail) {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->where('email', $phoneOrEmail)->orWhere('phone', $phoneOrEmail)->first();
        $this->resetModel();

        return $this->parserResult($model);
    }
}
