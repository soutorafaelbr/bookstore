<?php

namespace App\Domains\Stores\DTOS;

class PersistStoreDTO
{
    public function __construct(public string $name, public string $address, public bool $active) {}
}
