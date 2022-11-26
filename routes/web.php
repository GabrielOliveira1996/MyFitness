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
    Route::get('/all', [App\Http\Controllers\FoodController::class, 'allFoodsView'])->name('allFoodsView');
    Route::get('/update/{id}', [App\Http\Controllers\FoodController::class, 'updateFoodView'])->name('updateFoodView');
    Route::post('/update/{id}', [App\Http\Controllers\FoodController::class, 'updateFood'])->name('updateFood');
    Route::get('/delete/{id}', [App\Http\Controllers\FoodController::class, 'deleteFood'])->name('deleteFood');
});

Route::prefix('goal')->group(function () {
    Route::get('/list', [App\Http\Controllers\GoalController::class, 'goalView'])->name('goalView');
    Route::get('/add-food-to-day-goal', [App\Http\Controllers\GoalController::class, 'addFoodToDayGoalView'])->name('addFoodToDayGoalView');
    Route::post('/add-food-to-day-goal', [App\Http\Controllers\GoalController::class, 'addFoodToDayGoal'])->name('addFoodToDayGoal');
    Route::get('/update-food-to-day-goal/{id}', [App\Http\Controllers\GoalController::class, 'updateFoodToDayGoalView'])->name('updateFoodToDayGoalView');
    Route::post('/update-food-to-day-goal/{id}', [App\Http\Controllers\GoalController::class, 'updateFoodToDayGoal'])->name('updateFoodToDayGoal');
    Route::get('/delete-goal-food/{id}', [App\Http\Controllers\GoalController::class, 'deleteGoalFood'])->name('deleteGoalFood');
    Route::get('/setting-goal', [App\Http\Controllers\GoalController::class, 'settingGoalView'])->name('settingGoalView');
    Route::post('/setting-goal', [App\Http\Controllers\GoalController::class, 'settingGoal'])->name('settingGoal');
});
