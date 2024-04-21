<?php

namespace Http\Controllers;

use App\Models\Book;
use App\Models\Store;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookStoreControllerTest extends TestCase
{
    public function test_stores_book_relationship()
    {
        $book = Book::factory()->create();
        $store = Store::factory()->create();
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling()->postJson(route('store-books.store', ['store' => $store, 'book' => $book]));

        $this->assertDatabaseHas(
            'book_store',
            [
                'book_id' => $book->id,
                'store_id' => $store->id
            ]
        );
    }
}
