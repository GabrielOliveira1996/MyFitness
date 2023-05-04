<?php

namespace App\Repository\Goal;

interface IGoalRepository
{
    public function allGoalRepos();
    public function breakfastGoalFoodsRepos($date);
    public function lunchGoalFoodsRepos($date);
    public function snackGoalFoodsRepos($date);
    public function dinnerGoalFoodsRepos($date);
    public function preWorkoutGoalFoodsRepos($date);
    public function postWorkoutGoalFoodsRepos($date);
    public function addFoodToDayGoalRepos($data);
    public function deleteGoalFoodRepos($id);
    public function findFoodRepos($id);
    public function updateFoodToDayGoalRepos($id);
    public function searchGoalRepos($data);
}
