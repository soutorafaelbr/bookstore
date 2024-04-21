<?php

namespace App\Http\Controllers;

use App\Domains\Books\DTOS\PersistBookDTO;
use App\Domains\Books\Repositories\BookRepository;
use App\Http\Requests\Books\BookRequest;
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
}
