<?php

namespace App\Repositories\Contracts;


interface RepositoryInterface
{
    public function all(array $columns = [],array $relations = []);

    public function paginate(int $page, $columns = ['*'], $pageName = 'page', int $per_page = 50);

    public function find(int $ID, array $columns = null);

    public function findBy(array $criteria, array $columns = null, bool $single = true);

    public function store(array $item);

    public function storeMany(array $items);

    public function update(int $ID, array $item);

    public function updateBy(array $criteria, array $data);

    public function delete(int $ID);

    public function deleteBy(array $criteria);



}
