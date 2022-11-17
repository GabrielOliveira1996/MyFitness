<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('food')->group(function () {
    Route::get('/search', [App\Http\Controllers\FoodController::class, 'searchFoodView']);
    Route::get('/create', [App\Http\Controllers\FoodController::class, 'createFoodView']);
    Route::post('/create', [App\Http\Controllers\FoodController::class, 'createFood'])
        ->name('createFood');
});
