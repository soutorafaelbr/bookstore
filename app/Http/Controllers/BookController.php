<?php

namespace App\Http\Controllers;

use App\Domains\Books\DTOS\PersistBookDTO;
use App\Domains\Books\Repositories\BookRepository;
use App\Http\Requests\Books\BookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function __construct(private BookRepository $bookRepository) {}

    public function store(BookRequest $request): JsonResponse
    {
        $book = $this->bookRepository->create(
            new PersistBookDTO(
                name: $request->input('name'),
                isbn: $request->input('isbn'),
                value: $request->input('value'),
            )
        );

        return response()->json($book, JsonResponse::HTTP_CREATED);
    }

    public function update(Book $book, BookRequest $request): JsonResponse
    {
        $book = $this->bookRepository->update(
            $book,
            new PersistBookDTO(
                name: $request->input('name'),
                isbn: $request->input('isbn'),
                value: $request->input('value'),
            )
        );

        return response()->json(
            [
                'name' => $book->name,
                'isbn' => $book->isbn,
                'value' => (float) $book->value,
            ],
            JsonResponse::HTTP_OK
        );
    }

    public function delete(Book $book): JsonResponse
    {
        $this->bookRepository->delete($book);

        return response()->json([], JsonResponse::HTTP_NO_CONTENT);
    }

    public function index(): JsonResponse
    {
        $books = $this->bookRepository->getPaginated();

        return response()->json($books->toArray(), JsonResponse::HTTP_OK);
    }
}
