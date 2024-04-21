<?php

namespace App\Domains\Books\Repositories;

use App\Models\Book;
use App\Repositories\Repository;
use App\Domains\Books\DTOS\PersistBookDTO;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function update(Book $book, PersistBookDTO $persistBookDTO): Book
    {
         $book->update([
            'name' => $persistBookDTO->name,
            'isbn' => $persistBookDTO->isbn,
            'value' => $persistBookDTO->value,
        ]);

         return $book->refresh();
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->query()->paginate();
    }
}
