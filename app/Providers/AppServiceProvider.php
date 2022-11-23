<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        App::bind('App\Contracts\IFoodRepos', 'App\Repos\FoodRepos');
        App::bind('App\Contracts\IGoalRepos', 'App\Repos\GoalRepos');
    }

    public function boot()
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
