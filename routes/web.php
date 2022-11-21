<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('food')->group(function () {
    //Route::get('/search', [App\Http\Controllers\FoodController::class, 'searchFoodView']);
    Route::get('/create', [App\Http\Controllers\FoodController::class, 'createFoodView'])->name('createFoodView');
    Route::post('/create', [App\Http\Controllers\FoodController::class, 'createFood'])->name('createFood');
});

Route::prefix('{userName}')->group(function () {
    Route::get('/my-goals', [App\Http\Controllers\GoalsController::class, 'myGoalsView'])->name('myGoalsView');
});
