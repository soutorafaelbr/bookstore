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

    public function test_value_must_be_numeric()
    {
        $book = Book::factory()->make(['value' => 'string'])->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonValidationErrors('value');
    }

    public function test_value_is_required()
    {
        $book = Book::factory()->make(['value' => null])->toArray();

        Sanctum::actingAs(User::factory()->create());

        $this->postJson(route('books.store'), $book)
            ->assertJsonValidationErrors('value');
    }
}
