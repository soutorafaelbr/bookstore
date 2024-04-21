<?php

namespace App\Http\Controllers;

use App\Domains\Stores\DTOS\PersistStoreDTO;
use App\Domains\Stores\Repositories\StoreRepository;
use App\Http\Requests\Stores\StoreRequest;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private StoreRepository $storeRepository) {}

    public function store(StoreRequest $request): JsonResponse
    {
        $store = $this->storeRepository->create(
            new PersistStoreDTO(
                name: $request->get('name'),
                address: $request->get('address'),
                active: $request->get('active'),
            )
        );

        return response()->json($store->toArray(), JsonResponse::HTTP_CREATED);
    }

    public function update(Store $store, StoreRequest $request): JsonResponse
    {
        $store = $this->storeRepository->update(
            $store,
            new PersistStoreDTO(
                name: $request->get('name'),
                address: $request->get('address'),
                active: $request->get('active'),
            )
        );

        return response()->json($store->toArray(), JsonResponse::HTTP_OK);
    }
}
