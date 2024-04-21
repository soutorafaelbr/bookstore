<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    public function __construct(protected Model $model) {}

    public function query(): Builder
    {
        return $this->model->query();
    }
}
