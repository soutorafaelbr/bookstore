<?php

namespace App\Domains\Stores\Repositories;

use App\Domains\Stores\DTOS\CreateStoreDTO;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class StoreEloquentRepository extends Repository implements StoreRepository
{
    public function create(CreateStoreDTO $createStoreDTO): Model
    {
        return $this->query()->create([
            'name' => $createStoreDTO->name,
            'address' => $createStoreDTO->address,
            'active' => $createStoreDTO->active,
        ]);
    }
}
