<?php

namespace Repositories;

use App\Domains\Books\DTOS\PersistBookDTO;
use App\Domains\Books\Repositories\BookRepository;
use App\Models\Book;
use Mockery;
use Tests\TestCase;

class BookRepositoryTest extends TestCase
{
    private BookRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(BookRepository::class);
    }

    public function test_create()
    {
        $this->repository->create(
            $dto = new PersistBookDTO(
                name: 'name',
                isbn: 12345,
                value: 10.00
            )
        );

        $this->assertDatabaseHas(
            'books',
            [
                'name' => $dto->name,
                'isbn' => $dto->isbn,
                'value' => $dto->value,
            ]
        );
    }

    public function test_update()
    {
        Book::factory()->create();

        $this->repository->create(
            $dto = new PersistBookDTO(
                name: 'name',
                isbn: 12345,
                value: 10.00
            )
        );

        $this->assertDatabaseHas(
            'books',
            [
                'name' => $dto->name,
                'isbn' => $dto->isbn,
                'value' => $dto->value,
            ]
        );
    }

    public function test_delete()
    {
        $book = Book::factory()->create();

        $this->repository->delete($book);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_get()
    {
        $book = Book::factory()->create();

        $response = $this->repository->getPaginated();

        $this->assertTrue($response->contains($book));
    }
}
