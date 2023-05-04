<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        App::bind('App\Repository\User\IUserRepository', 'App\Repository\User\UserRepository');
        App::bind('App\Repository\Food\IFoodRepository', 'App\Repository\Food\FoodRepository');
        App::bind('App\Repository\Goal\IGoalRepository', 'App\Repository\Goal\GoalRepository');
        App::bind('App\Repository\BasalMetabolicRate\IBasalMetabolicRateRepository', 'App\Repository\BasalMetabolicRate\BasalMetabolicRateRepository');
    }

    public function boot()
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
