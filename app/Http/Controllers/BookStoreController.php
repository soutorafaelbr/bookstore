<?php

namespace App\Http\Controllers;

use App\Domains\Stores\Repositories\StoreRepository;
use App\Models\Book;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    public function __invoke(Store $store, Book $book, StoreRepository $repository): JsonResponse
    {
        $repository->associateBook($store, $book);

        return response()->json([$store->fresh()], JsonResponse::HTTP_CREATED);
    }
}
