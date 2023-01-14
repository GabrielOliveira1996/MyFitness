<?php

namespace App\Contracts;

interface IGoalRepos {

    public function allGoalRepos();
    public function breakfastGoalFoodsRepos();
    public function lunchGoalFoodsRepos();
    public function snackGoalFoodsRepos();
    public function dinnerGoalFoodsRepos();
    public function preWorkoutGoalFoodsRepos();
    public function postWorkoutGoalFoodsRepos();
    public function addFoodToDayGoalRepos($data);
    public function deleteGoalFoodRepos($id);
    public function findFoodRepos($id);
    public function updateFoodToDayGoalRepos($id);
}