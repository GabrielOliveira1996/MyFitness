<?php

namespace App\Contracts;

interface IFoodRepos {

    public function allFoodRepos();
    public function createFoodRepos($data);
    public function userListFoodRepos();

}