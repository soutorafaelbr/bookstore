<?php

namespace App\Domains\Books\Repositories;


use App\Domains\Books\DTOS\PersistBookDTO;

interface BookRepository
{
    public function create(PersistBookDTO $persistBookDTO);
}
