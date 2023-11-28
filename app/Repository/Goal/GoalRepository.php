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

    public function create($goal, $user, $date){
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
            'type_of_meal' => $goal['type_of_meal']
        ]);
    }

    public function find($id)
    {
        return $this->_goal->find($id);
    }
    
    public function update($goal){
        return $this->_goal->where('id', $goal['id'])->update([
            'name' => $goal['name'],
            'quantity_grams' => $goal['quantity_grams'],
            'calories' => $goal['calories'],
            'carbohydrate' => $goal['carbohydrate'],
            'protein' => $goal['protein'],
            'total_fat' => $goal['total_fat'],
            'saturated_fat' => $goal['saturated_fat'],
            'trans_fat' => $goal['trans_fat'],
            'type_of_meal' => $goal['type_of_meal']
        ]);
    }

    public function delete($id){
        return $this->_goal->where('id', $id)->delete();
    }

    // Função responsável por buscar uma refeição com 
    // base na data de cadastro e no tipo de refeição.
    public function findByDateAndMealType($date, $type_of_meal){
        return $this->_goal->whereDate('created_at', $date)
                            ->where('type_of_meal', $type_of_meal)
                            ->get();
    }

    public function searchFoodGoal($goal, $date, $user){
        // Função responsável por buscar refeição por nome, 
        // tipo, ID de usuário e data de criação.
        return $this->_goal->where('name', $goal['name'])
                            ->where('type_of_meal', $goal['type_of_meal'])
                            ->where('user_id', $user->id)
                            ->whereDate('created_at', $date)
                            ->first();
    }

    public function goalFoods($date, $user){
        return \DB::table('goals')
                    ->where('user_id', $user->id)
                    ->whereDate('created_at', $date)
                    ->select('id',
                                'name', 
                                'type_of_meal', 
                                'quantity_grams',
                                'calories', 
                                'carbohydrate', 
                                'protein',
                                'total_fat',
                                'saturated_fat',
                                'trans_fat')->get();
    } 

    public function totalConsumption($date, $user){
        return \DB::table('goals')
                    ->where('user_id', $user->id)
                    ->whereDate('created_at', $date)
                    ->select(\DB::raw('sum(calories) as total_calories, 
                                        sum(carbohydrate) as total_carbohydrate,
                                        sum(protein) as total_protein,
                                        sum(total_fat) as total_fat'))->get();
    }

}
