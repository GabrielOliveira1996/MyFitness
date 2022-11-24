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
    Route::get('/user-foods', [App\Http\Controllers\FoodController::class, 'userListFoodView'])->name('userListFoodView');
});

Route::prefix('goals')->group(function () {
    Route::get('/list', [App\Http\Controllers\GoalsController::class, 'myGoalsView'])->name('myGoalsView');
    Route::get('/add-food-to-day-goal', [App\Http\Controllers\GoalsController::class, 'addFoodToDayGoalView'])->name('addFoodToDayGoalView');
    Route::post('/add-food-to-day-goal', [App\Http\Controllers\GoalsController::class, 'addFoodToDayGoal'])->name('addFoodToMyDayGoal');
    Route::get('/delete-goal-food/{id}', [App\Http\Controllers\GoalsController::class, 'deleteGoalFood'])->name('deleteGoalFood');
    Route::get('/setting-goals', [App\Http\Controllers\GoalsController::class, 'settingGoalsView'])->name('settingGoalsView');
    Route::post('/setting-goals', [App\Http\Controllers\GoalsController::class, 'settingGoals'])->name('settingGoals');
});
