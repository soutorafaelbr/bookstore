<?php

namespace App\Domains\Stores\Repositories;

use App\Domains\Stores\DTOS\PersistStoreDTO;
use App\Models\Store;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StoreEloquentRepository extends Repository implements StoreRepository
{
    public function create(PersistStoreDTO $persistStoreDTO): Model
    {
        return $this->query()->create([
            'name' => $persistStoreDTO->name,
            'address' => $persistStoreDTO->address,
            'active' => $persistStoreDTO->active,
        ]);
    }

    public function update(Store $store, PersistStoreDTO $persistStoreDTO)
    {
        $store->update([
            'name' => $persistStoreDTO->name,
            'address' => $persistStoreDTO->address,
            'active' => $persistStoreDTO->active,
        ]);

        return $store->fresh();
    }

    public function delete(Store $store): void
    {
        $store->delete();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->query()->paginate(10);
    }
}
