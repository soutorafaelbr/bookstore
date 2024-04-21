<?php

namespace Repositories;

use App\Domains\Stores\DTOS\PersistStoreDTO;
use App\Domains\Stores\Repositories\StoreRepository;
use App\Models\Book;
use App\Models\Store;
use Tests\TestCase;

class StoreRepositoryTest extends TestCase
{
    private StoreRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(StoreRepository::class);
    }

    public function test_create()
    {
        $this->repository->create(
            $dto = new PersistStoreDTO(
                name: 'name',
                address: 'address',
                active: true
            )
        );

        $this->assertDatabaseHas(
            'stores',
            [
                'name' => $dto->name,
                'address' => $dto->address,
                'active' => $dto->active,
            ]
        );
    }

    public function test_update()
    {
        $store = Store::factory()->create();

        $this->repository->update(
            $store,
            $dto = new PersistStoreDTO(
                name: 'name',
                address: 'address',
                active: true
            )
        );

        $this->assertDatabaseHas(
            'stores',
            [
                'name' => $dto->name,
                'address' => $dto->address,
                'active' => $dto->active,
            ]
        );
    }

    public function test_delete()
    {
        $store = Store::factory()->create();

        $this->repository->delete($store);

        $this->assertDatabaseMissing('stores', ['id' => $store->id]);
    }

    public function test_get()
    {
        $store = Store::factory()->create();

        $response = $this->repository->getPaginated();

        $this->assertTrue($response->contains($store));
    }

    public function test_book_store()
    {
        $store = Store::factory()->create();
        $book = Book::factory()->create();

        $this->repository->associateBook($store, $book);

        $this->assertDatabaseHas('book_store', ['store_id' => $store->id, 'book_id' => $book->id]);
    }
}
