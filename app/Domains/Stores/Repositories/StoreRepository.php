<?php

namespace App\Domains\Stores\Repositories;

use App\Domains\Stores\DTOS\PersistStoreDTO;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

interface StoreRepository
{
    public function create(PersistStoreDTO $persistStoreDTO): Model;

    public function update(Store $store, PersistStoreDTO $persistStoreDTO);

    public function delete(Store $store);

    public function getPaginated();
}
