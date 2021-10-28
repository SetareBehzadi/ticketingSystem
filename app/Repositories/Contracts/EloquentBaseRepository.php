<?php

namespace App\Repositories\Contracts;


use Illuminate\Support\Facades\DB;

class EloquentBaseRepository implements RepositoryInterface
{
    protected $model;

    public function find(int $ID, array $columns = null)
    {
        return $this->model::find($ID);
    }

    public function store(array $item)
    {
        return $this->model::create($item);
    }

    public function update(int $ID, array $item)
    {
        $item = $this->find($ID);
        if ($item) {
            return $item->update($item);
        }

        return null;
    }

    public function delete(int $ID)
    {
        if (intval($ID) > 0) {
            return $this->model::destroy($ID);
        }

        return null;
    }

    public function findBy(array $criteria, array $columns = null, bool $single = true)
    {
        $query = $this->model::query();
        foreach ($criteria as $key => $item) {
            $query->where($key, $item);
        }
        $method = $single ? 'first' : 'get';

        return is_null($columns) ? $query->{$method}() : $query->{$method}($columns);
    }

    public function updateBy(array $criteria, array $data)
    {
        $query = $this->model::query();
        foreach ($criteria as $key => $value) {
            $query->where($key, $value);
        }

        return $query->update($data);
    }

    public function deleteBy(array $criteria)
    {
        $query = $this->model::query();
        foreach ($criteria as $key => $value) {
            $query->where($key, $value);
        }

        return $query->delete();
    }

    public function all(array $columns = null, array $relations = [])
    {
        $query = $this->model::query();
        if (!empty($relations)) {
            $query->with($relations);
        }
        if (!is_null($columns)) {
            return $query->get($columns);
        }

        return $query->get();
    }

    // return $this->query->paginate($perPage, $columns, $pageName, $page);
    public function paginate(int $page, $columns = ['*'], $pageName = 'page', int $per_page = 50)
    {
        return $this->model::paginate($per_page, $columns, $pageName, $per_page);
    }

    public function storeMany(array $items)
    {
        return $this->model::createMany($items);
    }

    public function findWith(int $id,$relations = [])
    {
        if(!empty($relations))
        {
            return $this->model::with($relations)->where((new $this->model)->getKeyName(),$id)->get();
        }
        return $this->model::find($id);

    }


    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function commit()
    {
        DB::commit();
    }

    public function rollBack()
    {
        DB::rollBack();
    }


}
