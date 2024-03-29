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

Route::get('/recover-password', function(){return view('user.email');})->name('recover-password')->middleware('guest');
Route::post('/recover-password', [App\Http\Controllers\User\UserManagementController::class, 'sendEmailToRecoverPassword'])->middleware('guest')->name('send.email.to.recover.password');
Route::get('/reset-password/{token}', function (string $token) {
    return view('user.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password/{token}', [App\Http\Controllers\User\UserManagementController::class, 'resetPassword'])->middleware('guest')->name('password.reset.post');

Route::get('/login-google', [App\Http\Controllers\User\SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login-google/callback', [App\Http\Controllers\User\SocialAuthController::class, 'googleCallback']);

Route::prefix('food')->group(function () {
    Route::post('/create', [App\Http\Controllers\Food\FoodManagementController::class, 'create'])->name('food.create');
    Route::get('/delete/{id}', [App\Http\Controllers\Food\FoodManagementController::class, 'delete'])->name('food.delete');
    Route::get('/all/search', [App\Http\Controllers\Food\FoodManagementController::class, 'search'])->name('food.search');
    Route::get('/all', [App\Http\Controllers\Food\FoodController::class, 'index'])->name('food.all');
    Route::post('/update', [App\Http\Controllers\Food\FoodManagementController::class, 'update'])->name('food.update');
});

Route::prefix('goal')->group(function () {
    Route::get('/{date}', [App\Http\Controllers\Goal\GoalController::class, 'index'])->name('goal.index');
    //Route::get('/{date}/search-goal-by-date', [App\Http\Controllers\Goal\GoalManagementController::class, 'searchGoalByDate'])->name('goal.search');
    Route::post('/save-goal', [App\Http\Controllers\User\UserManagementController::class, 'updateProfile'])->name('goal.save');
    Route::post('/{date}/create', [App\Http\Controllers\Goal\GoalManagementController::class, 'add'])->name('goal.add');
    Route::post('/{date}/update', [App\Http\Controllers\Goal\GoalManagementController::class, 'update'])->name('goal.updatefood');
    //Route::get('/{date}/delete/{id}', [App\Http\Controllers\Goal\GoalManagementController::class, 'delete'])->name('goal.delete');
});
// Ao chamar as rotas, é necessário que o token seja adicionado ao cabeçalho da requisição.
Route::prefix('settings')->group(function(){
    Route::get('/informations', [App\Http\Controllers\User\UserController::class, 'settings'])->name('user.settings');
    Route::post('/informations/public-perfil-update', [App\Http\Controllers\User\UserManagementController::class, 'publicProfileUpdate'])->name('public-perfil.update');
    Route::post('/informations/image-perfil-update', [App\Http\Controllers\User\UserManagementController::class, 'profilePictureUpdate'])->name('perfil-image.update');
    //Route::get('/search/{name}', [App\Http\Controllers\User\UserController::class, 'searchUsers'])->name('user.search');
    //Route::post('/search/{name}', [App\Http\Controllers\User\UserController::class, 'searchUsers'])->name('user.search');
});

Route::prefix('community')->group(function(){
    Route::get('/', [App\Http\Controllers\User\UserController::class, 'community'])->name('community.index');
    Route::get('/search-users', [App\Http\Controllers\User\UserManagementController::class, 'searchUsers'])->name('community.search');
    Route::post('/follow-user/{nickname}', [App\Http\Controllers\User\UserManagementController::class, 'followUser'])->name('follow.user');
    Route::post('/unfollow-user/{nickname}', [App\Http\Controllers\User\UserManagementController::class, 'unfollowUser'])->name('unfollow.user');
    Route::get('/{nickname}', [App\Http\Controllers\User\UserController::class, 'userProfile'])->name('community.userprofile');
    Route::get('/{nickname}/followers', [App\Http\Controllers\User\UserController::class, 'allFollowers'])->name('community.allFollowers');
});

Route::prefix('post')->group(function(){
    Route::post('/create', [App\Http\Controllers\Post\PostManagementController::class, 'create'])->name('post.create');
    Route::get('/delete/{id}', [App\Http\Controllers\Post\PostManagementController::class, 'delete'])->name('post.delete');
    Route::post('/update', [App\Http\Controllers\Post\PostManagementController::class, 'update'])->name('post.update');
});

Route::prefix('comment')->group(function(){
    Route::post('/create', [App\Http\Controllers\Comment\CommentManagementController::class, 'create'])->name('comment.create');
    Route::get('/delete/{id}', [App\Http\Controllers\Comment\CommentManagementController::class, 'delete'])->name('comment.delete');
    Route::post('/update', [App\Http\Controllers\Comment\CommentManagementController::class, 'update'])->name('comment.update');
});

Route::prefix('diets')->group(function () {
    Route::get('/', [App\Http\Controllers\Diet\DietController::class, 'index'])->name('diet.index');
});

