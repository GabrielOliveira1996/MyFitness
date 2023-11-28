<?php

namespace App\Repository\Goal;

interface IGoalRepository
{
    public function create($goal, $user, $date);
    public function find($id);
    public function update($goal);
    public function delete($id);
    public function findByDateAndMealType($date, $type_of_meal);
    public function searchFoodGoal($goal, $date, $user);
    public function goalFoods($date, $user);
    public function totalConsumption($date, $user);
}
