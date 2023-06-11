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
        ]);
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
        return $this->_goal->where('id', $id)
                            ->delete();
    }

    // Função responsável por buscar uma refeição com 
    // base na data de cadastro e no tipo de refeição.
    public function findByDateAndMealType($date, $type_of_meal)
    {
        return $this->_goal->whereDate('created_at', $date)
                            ->where('type_of_meal', $type_of_meal)
                            ->get();
    }

    public function searchFoodGoal($name, $type_of_meal, $date, $user)
    {
        // Função responsável por buscar refeição por nome, 
        // tipo, ID de usuário e data de criação.
        return $this->_goal->where('name', $name)
                            ->where('type_of_meal', $type_of_meal)
                            ->where('user_id', $user->id)
                            ->whereDate('created_at', $date)
                            ->first();
    }
}
