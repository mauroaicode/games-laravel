<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function paginate();

    public function create(array $data);

    public function update(array $data, string $id);

    public function delete(string $id);

    public function find(string $id);
}
