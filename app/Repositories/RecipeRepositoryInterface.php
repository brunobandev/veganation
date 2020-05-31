<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RecipeRepositoryInterface
{
    public function all(): Collection;

    public function latest(int $take): Collection;

    public function beforeLatest(int $take, int $skip): Collection;

    public function find(int $id): ?Model;

    public function findByCategoryId(int $categoryId): Collection;

    public function findByUserId(int $userId): Collection;

    public function findBySlug(string $slug): ?Model;

    public function create(array $attributes): Model;

    public function update(int $id, array $attributes): ?Model;

    public function delete(int $id): int;
}
