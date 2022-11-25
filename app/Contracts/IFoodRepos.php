<?php

namespace App\Contracts;

interface IFoodRepos {

    public function allFoodRepos();
    public function createFoodRepos($data);
    public function userListFoodRepos();
    public function findFoodRepos($id);
    public function updateFoodRepos($id);
    public function deleteFoodRepos($id);

}