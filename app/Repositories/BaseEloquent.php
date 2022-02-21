<?php

namespace App\Repositories;

use App\Repositories\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BaseEloquent extends BaseRepository implements \App\Repositories\BaseRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        // TODO: Implement model() method.
    }

    public function findWhere(array $where, $columns = ['*'], $with = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->with($with)->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    public function findFirst(array $where, $columns = ['*'], $with = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->with($with)->select($columns)->first();
        $this->resetModel();

        return $this->parserResult($model);
    }
}
