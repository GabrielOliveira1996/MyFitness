<?php

namespace App\Contracts;

interface IFoodRepos {

    public function allFoodsRepos();
    public function createFoodRepos($user, $data);
    public function findFoodRepos($id);
    public function updateFoodRepos($id);
    public function deleteFoodRepos($id);

}