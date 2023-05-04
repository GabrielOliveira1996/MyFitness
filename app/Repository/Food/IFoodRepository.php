<?php

namespace App\Repository\Food;

interface IFoodRepository
{
    public function allFoodsRepos();
    public function createFoodRepos($user, $data);
    public function findFoodRepos($id);
    public function updateFoodRepos($user, $id);
    public function deleteFoodRepos($id);
}
