<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        App::bind('App\Repository\User\IUserRepository', 'App\Repository\User\UserRepository');
        App::bind('App\Repository\Food\IFoodRepository', 'App\Repository\Food\FoodRepository');
        App::bind('App\Repository\Goal\IGoalRepository', 'App\Repository\Goal\GoalRepository');
        App::bind('App\Repository\Post\IPostRepository', 'App\Repository\Post\PostRepository');
        App::bind('App\Repository\Follower\IFollowerRepository', 'App\Repository\Follower\FollowerRepository');
        App::bind('App\Repository\Comment\ICommentRepository', 'App\Repository\Comment\CommentRepository');
    }

    public function boot()
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        if(env('FORCE_HTTPS',false)){
            URL::forceScheme('https');
        }
    }
}
