<?php

namespace App\Domains\Books\Repositories;

use App\Models\Book;
use App\Repositories\Repository;
use App\Domains\Books\DTOS\PersistBookDTO;

class BookEloquentRepository extends Repository implements BookRepository
{
    public function create(PersistBookDTO $persistBookDTO): Book
    {
        return $this->query()->create([
            'name' => $persistBookDTO->name,
            'isbn' => $persistBookDTO->isbn,
            'value' => $persistBookDTO->value,
        ]);
    }
}
