<?php

namespace App\Domains\Stores\DTOS;

class CreateStoreDTO
{
    public function __construct(public string $name, public string $address, public bool $active) {}
}
