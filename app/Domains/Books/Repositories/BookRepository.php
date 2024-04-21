<?php

namespace App\Domains\Books\Repositories;


use App\Domains\Books\DTOS\PersistBookDTO;
use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepository
{
    public function create(PersistBookDTO $persistBookDTO);

    public function update(Book $book, PersistBookDTO $persistBookDTO): Book;

    public function delete(Book $book);

    public function getPaginated(): LengthAwarePaginator;
}
