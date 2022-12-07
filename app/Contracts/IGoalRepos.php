<?php

namespace App\Contracts;

interface IGoalRepos {

    public function allGoalRepos();
    public function goalFoodOfTheDayRepos();
    public function addFoodToDayGoalRepos($data);
    public function deleteGoalFoodRepos($id);
    public function findFoodRepos($id);
    public function updateFoodToDayGoalRepos($id);
}