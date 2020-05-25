<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface MeasureRepositoryInterface
{
    public function all(): Collection;
}
