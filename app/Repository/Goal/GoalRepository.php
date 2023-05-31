<?php

namespace App\Repository\Goal;

use App\Repository\Goal\IGoalRepository;
use App\Models\Goal;

class GoalRepository implements IGoalRepository
{
    private $_goal;

    public function __construct(Goal $goal)
    {
        $this->_goal = $goal;
    }

    public function create($type, $goal, $user)
    {
        return $this->_goal->create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'name' => $goal['name'],
            'quantity_grams' => $goal['quantity_grams'],
            'calories' => $goal['calories'],
            'carbohydrate' => $goal['carbohydrate'],
            'protein' => $goal['protein'],
            'total_fat' => $goal['total_fat'],
            'saturated_fat' => $goal['saturated_fat'],
            'trans_fat' => $goal['trans_fat'],
            'type_of_meal' => $type
        ]);;
    }

    public function find($id)
    {
        return $this->_goal->find($id);
    }

    public function update($id, $goal)
    {
        return $this->_goal->where('id', $id)->update([
            'name' => $goal['name'],
            'quantity_grams' => $goal['quantity_grams'],
            'calories' => $goal['calories'],
            'carbohydrate' => $goal['carbohydrate'],
            'protein' => $goal['protein'],
            'total_fat' => $goal['total_fat'],
            'saturated_fat' => $goal['saturated_fat'],
            'trans_fat' => $goal['trans_fat'],
        ]);
    }

    public function delete($id)
    {
        return $this->_goal->where('id', $id)->delete();
    }

    // Funções que localizam por tipo de refeição.
    public function breakfast($date)
    {
        return $this->_goal->whereDate('created_at', $date)->where('type_of_meal', 1)->get();
    }

    public function lunch($date)
    {
        return $this->_goal->whereDate('created_at', $date)->where('type_of_meal', 2)->get();
    }

    public function snack($date)
    {
        return $this->_goal->whereDate('created_at', $date)->where('type_of_meal', 3)->get();
    }

    public function dinner($date)
    {
        return $this->_goal->whereDate('created_at', $date)->where('type_of_meal', 4)->get();
    }

    public function preWorkout($date)
    {
        return $this->_goal->whereDate('created_at', $date)->where('type_of_meal', 5)->get();
    }

    public function postWorkout($date)
    {
        return $this->_goal->whereDate('created_at', $date)->where('type_of_meal', 6)->get();
    }
}
