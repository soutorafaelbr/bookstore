<?php

namespace App\Domains\Stores\Repositories;

use App\Domains\Stores\DTOS\CreateStoreDTO;
use Illuminate\Database\Eloquent\Model;

interface StoreRepository
{
    public function create(CreateStoreDTO $createStoreDTO): Model;
}
