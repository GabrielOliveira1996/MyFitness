<?php

namespace App\Repository\Goal;

interface IGoalRepository
{
    public function create($type, $goal, $user);
    public function find($id);
    public function update($id, $goal);
    public function delete($id);
    public function breakfast($date);
    public function lunch($date);
    public function snack($date);
    public function dinner($date);
    public function preWorkout($date);
    public function postWorkout($date);
}
