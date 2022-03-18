<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HouseRepository;
use App\Entities\House;
use App\Validators\HouseValidator;

/**
 * Class HouseRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HouseRepositoryEloquent extends BaseRepository implements HouseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return House::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByUser(int $userId, array $searchCondition = [], array $with = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->where('user_id', $userId);

        if (!empty($searchCondition['search'])) {
            $results = $results->where('name', 'like', '%' . $searchCondition['search'] . '%');
        }

        if (!empty($searchCondition['status'])) {
            $results = $results->where('status', $searchCondition['status']);
        }

        if (!empty($searchCondition['category_id'])) {
            $results = $results->where('category_id', $searchCondition['category_id']);
        }

        if (!empty($searchCondition['order_key'])) {
            $results = $results->orderBy($searchCondition['order_key'], $searchCondition['order_by'] ?? 'DESC');
        } else {
            $results = $results->orderBy('id', 'DESC');
        }

        $results = $results->paginate(!empty($searchCondition['per_page']) ? $searchCondition['per_page'] : 25);

        $this->resetModel();

        return $this->parserResult($results);
    }

}
