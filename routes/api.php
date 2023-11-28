<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('goal')->group(function () {
    Route::get('/search-food', [App\Http\Controllers\Goal\ApiGoalController::class, 'searchFood'])->name('goal.searchFood');
    Route::delete('/delete', [App\Http\Controllers\Goal\ApiGoalController::class, 'delete'])->name('goal.delete');
    Route::get('/{date}', [App\Http\Controllers\Goal\ApiGoalController::class, 'index'])->name('goal.list');
    Route::get('/{date}/search-goal-by-date', [App\Http\Controllers\Goal\ApiGoalController::class, 'searchGoalByDate'])->name('goal.search');
});