<?php

namespace Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    public function test_responds_with_created_status()
    {
        $book = Book::factory()->make();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book->toArray())->assertCreated();
    }

    public function test_stores_book()
    {
        $book = Book::factory()->make()->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book);

        $this->assertDatabaseHas('books', $book);
    }

    public function test_responds_with_json()
    {
        $book = Book::factory()->make()->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonFragment($book);
    }

    public function test_name_is_required()
    {
        $book = Book::factory()->make(['name' => null])->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonValidationErrors('name');
    }

    public function test_isbn_is_required()
    {
        $book = Book::factory()->make(['isbn' => null])->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonValidationErrors('isbn');
    }

    public function test_isbn_must_be_integer()
    {
        $book = Book::factory()->make(['isbn' => 'string'])->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonValidationErrors('isbn');
    }

    public function test_value_is_required()
    {
        $book = Book::factory()->make(['value' => null])->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonValidationErrors('value');
    }

    public function test_updates_book()
    {
        $book = Book::factory()->create();

        Sanctum::actingAs(User::factory()->create());

        $this->putJson(route('books.update', $book), $updateBook = Book::factory()->make()->toArray())
            ->assertOk();

        $this->assertDatabaseHas('books', $updateBook);
    }
    public function test_respond_with_updated_book()
    {
        $book = Book::factory()->create();

        Sanctum::actingAs(User::factory()->create());

        $this->putJson(route('books.update', $book), $updateBook = Book::factory()->make()->toArray())
            ->assertJsonFragment([
                'name' => data_get($updateBook, 'name'),
                'isbn' => data_get($updateBook, 'isbn'),
                'value' => (float) data_get($updateBook, 'value'),
            ]);
    }

    public function test_deletes_book()
    {
        $book = Book::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson(route('books.delete', $book))->assertNoContent();
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_lists_books()
    {
        $book = Book::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->getJson(route('books.index'))
            ->assertOk()
            ->assertJsonFragment($book->toArray());
    }
}
