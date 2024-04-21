<?php

use App\Http\Controllers\Auth\AuthenticateUserController;
use App\Http\Controllers\Auth\LogoutController;
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

Route::patch('stores/{store}', [StoreController::class, 'update'])
    ->name('stores.update')
    ->middleware('auth:sanctum');

Route::post('stores', [StoreController::class, 'store'])
    ->name('stores.store')
    ->middleware('auth:sanctum');
