<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('food')->group(function () {
    Route::get('/all', [App\Http\Controllers\Api\FoodControllerAPI::class, 'allFood'])->name('allFood');
});