<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Model;
    public function create(array $attributes): Model;
    public function update(int $id, array $attributes): ?Model;
    public function delete(int $id): int;
}
