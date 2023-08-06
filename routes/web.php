<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', function(){return view('user.register');});
Route::post('/register', [App\Http\Controllers\User\UserManagementController::class, 'register'])->name('register');
Route::get('/login', function(){return view('user.login');});
Route::post('/login', [App\Http\Controllers\User\UserManagementController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\User\UserManagementController::class, 'logout'])->name('logout');
Route::get('/recover-password', function(){return view('user.email');})->name('recover.password');
//Route::post('/recover-password', [App\Http\Controllers\User\UserManagementController::class, 'login'])->name('login');

Route::get('/login-google', [App\Http\Controllers\User\SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login-google/callback', [App\Http\Controllers\User\SocialAuthController::class, 'googleCallback']);

Route::get('/profile', [App\Http\Controllers\User\UserController::class, 'profile'])->name('profile');
Route::post('/profile', [App\Http\Controllers\User\UserManagementController::class, 'updateProfile'])->name('updateProfile');

Route::prefix('food')->group(function () {
    // Próxima correção será realizada em rota search.
    Route::match(['get', 'post'], '/all/search', [App\Http\Controllers\Food\FoodManagementController::class, 'search'])->name('food.search');
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
    Route::post('/index/search-by-date', [App\Http\Controllers\Goal\GoalManagementController::class, 'searchGoalByDate'])->name('goal.search');
    Route::match(['get', 'post'], '/create/{type}/search', [App\Http\Controllers\Goal\GoalManagementController::class, 'searchFood'])->name('goal.searchFood');
});
