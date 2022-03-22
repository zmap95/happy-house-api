<?php

namespace App\Services;

class BaseService {
    protected $repository;

    public function create(array $data) {
        return $this->repository->create($data);
    }

    public function find(int $id) {
        return $this->repository->find($id);
    }

    public function update(array $data, int $id) {
        return $this->repository->update($data, $id);
    }

    public function findWhere(array $whereData = [], array $select = ['*'], array $with = []) {
        return $this->repository->findWhere($whereData, $select, $with);
    }

    public function findFirst(array $where, $columns = ['*'], $with = []) {
        return $this->repository->findFirst($where, $columns, $with);
    }

    public function delete(int $id) {
        return $this->repository->delete($id);
    }

    public function paginate($limit = null, $column = ['*'], $where = []) {
        return $this->repository->paginate($limit, $column, $where);
    }
}
