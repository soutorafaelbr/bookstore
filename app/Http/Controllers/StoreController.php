<?php

namespace App\Http\Controllers;

use App\Domains\Stores\DTOS\CreateStoreDTO;
use App\Domains\Stores\Repositories\StoreRepository;
use App\Http\Requests\Stores\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private StoreRepository $storeRepository) {}

    public function store(StoreRequest $request): JsonResponse
    {
        $store = $this->storeRepository->create(
            new CreateStoreDTO(
                name: $request->get('name'),
                address: $request->get('address'),
                active: $request->get('active'),
            )
        );

        return response()->json($store->toArray(), JsonResponse::HTTP_CREATED);
    }
}
