<?php

namespace App\Contracts;

interface IGoalRepos {

    public function allGoalRepos();
    public function goalFoodOfTheDay();
    public function addFoodToDayGoalRepos($data);

}