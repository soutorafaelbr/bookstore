<?php

use App\Http\Controllers\Auth\AuthenticateUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/user', AuthenticateUserController::class)->name('auth.user');

Route::post('auth/logout', LogOutController::class)
    ->name('auth.logout')
    ->middleware('auth:sanctum');

Route::put('stores/{store}', [StoreController::class, 'update'])
    ->name('stores.update')
    ->middleware('auth:sanctum');

Route::post('stores', [StoreController::class, 'store'])
    ->name('stores.store')
    ->middleware('auth:sanctum');

Route::get('stores', [StoreController::class, 'index'])
    ->name('stores.index')
    ->middleware('auth:sanctum');

Route::delete('stores/{store}', [StoreController::class, 'delete'])
    ->name('stores.delete')
    ->middleware('auth:sanctum');

Route::post('books', [BookController::class, 'store'])
    ->name('books.store')
    ->middleware('auth:sanctum');

Route::put('books/{book}', [BookController::class, 'update'])
    ->name('books.update')
    ->middleware('auth:sanctum');

Route::delete('books/{book}', [BookController::class, 'delete'])
    ->name('books.delete')
    ->middleware('auth:sanctum');

Route::get('books', [BookController::class, 'index'])
    ->name('books.index')
    ->middleware('auth:sanctum');

Route::post('store/{store}/books/{book}', BookStoreController::class)
    ->name('store-books.store')
    ->middleware('auth:sanctum');
