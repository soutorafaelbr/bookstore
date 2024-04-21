<?php

namespace App\Providers;

use App\Domains\Stores\Repositories\StoreEloquentRepository;
use App\Domains\Stores\Repositories\StoreRepository;
use App\Domains\Books\Repositories\BookEloquentRepository;
use App\Domains\Books\Repositories\BookRepository;
use App\Models\Book;
use App\Models\Store;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(StoreRepository::class, fn() => new StoreEloquentRepository(new Store()));
        $this->app->singleton(BookRepository::class, fn() => new BookEloquentRepository(new Book()));
    }
}
