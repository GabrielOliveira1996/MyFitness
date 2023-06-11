<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::auth();

Route::get('/login-google', [App\Http\Controllers\User\SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login-google/callback', [App\Http\Controllers\User\SocialAuthController::class, 'googleCallback']);

Route::get('/profile', [App\Http\Controllers\User\UserController::class, 'profile'])->name('profile');
Route::post('/profile', [App\Http\Controllers\User\UserManagementController::class, 'updateProfile'])->name('updateProfile');

Route::prefix('food')->group(function () {
    // Próxima correção será realizada em rota search.
    Route::post('/all/search', [App\Http\Controllers\Food\FoodManagementController::class, 'search'])->name('food.search');
    Route::get('/all', [App\Http\Controllers\Food\FoodController::class, 'indexUserFoods'])->name('food.all');
    Route::post('/create', [App\Http\Controllers\Food\FoodManagementController::class, 'create']);
    Route::get('/create', [App\Http\Controllers\Food\FoodController::class, 'create'])->name('food.create');
    Route::post('/update/{id}', [App\Http\Controllers\Food\FoodManagementController::class, 'update']);
    Route::get('/update/{id}', [App\Http\Controllers\Food\FoodController::class, 'update'])->name('food.update');
    Route::get('/delete/{id}', [App\Http\Controllers\Food\FoodManagementController::class, 'delete'])->name('food.delete');
});

Route::prefix('goal')->group(function () {
    Route::get('/index', [App\Http\Controllers\Goal\GoalController::class, 'index'])->name('goal.index');
    Route::post('/create/{type}', [App\Http\Controllers\Goal\GoalManagementController::class, 'add'])->name('goal.addfood');
    Route::get('/create/{type}', [App\Http\Controllers\Goal\GoalController::class, 'add'])->name('goal.add');
    Route::post('/update/{id}', [App\Http\Controllers\Goal\GoalManagementController::class, 'update'])->name('goal.updatefood');
    Route::get('/update/{id}', [App\Http\Controllers\Goal\GoalController::class, 'update'])->name('goal.update');
    Route::get('/delete/{id}', [App\Http\Controllers\Goal\GoalManagementController::class, 'delete'])->name('goal.delete');
    Route::post('/search', [App\Http\Controllers\Goal\GoalController::class, 'search'])->name('goal.search');
});
