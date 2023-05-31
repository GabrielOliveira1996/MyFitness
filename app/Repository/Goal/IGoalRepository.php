<?php

namespace App\Repository\Goal;

interface IGoalRepository
{
    public function create($type, $goal, $user);
    public function find($id);
    public function update($id, $goal);
    public function delete($id);
    public function findByDateAndMealType($date, $type_of_meal);
    public function searchFoodGoal($name, $type_of_meal, $date, $user);
}
