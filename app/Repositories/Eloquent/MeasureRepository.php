<?php

namespace App\Repositories\Eloquent;

use App\Measure;
use App\Repositories\MeasureRepositoryInterface;

class MeasureRepository extends BaseRepository implements MeasureRepositoryInterface
{

    public function __construct(Measure $model)
    {
        parent::__construct($model);
    }
}
