<?php

namespace App\Services;

use App\Repository\Goal\IGoalRepository;
use Illuminate\Support\Facades\Auth;
use App\Validator\GoalValidator;

class GoalService
{
    private $_goalRepository;
    private $_goalValidator;
    private $_timezone;

    public function __construct(IGoalRepository $goalRepository, GoalValidator $goalValidator)
    {
        $this->_goalRepository = $goalRepository;
        $this->_goalValidator = $goalValidator;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function create($type, $goal)
    {
        $goal += ['type_of_meal' => $type];
        $user = Auth::user();
        $date = date('Y-m-d');
        $this->_goalValidator->food($goal);

        $searchGoal = $this->_goalRepository
                            ->searchFoodGoal($goal['name'], $goal['type_of_meal'], $date);
        
        if($searchGoal != null) {
            $sumGoal = [
                'name' => $goal['name'],
                'quantity_grams' => $goal['quantity_grams'] + $searchGoal['quantity_grams'],
                'calories' => $goal['calories'] + $searchGoal['calories'],
                'carbohydrate' => $goal['carbohydrate'] + $searchGoal['carbohydrate'],
                'protein' => $goal['protein'] + $searchGoal['protein'],
                'total_fat' => $goal['total_fat'] + $searchGoal['total_fat'],
                'saturated_fat' => $goal['saturated_fat'] + $searchGoal['saturated_fat'],
                'trans_fat' => $goal['trans_fat'] + $searchGoal['trans_fat'],
                'type_of_meal' => $goal['type_of_meal']
            ];
            $update = $this->_goalRepository->update($searchGoal['id'], $sumGoal);
            return $update;
        }
        $create = $this->_goalRepository->create($type, $goal, $user);
        return $create;
    }

    public function update($id, $goal)
    {
        $this->_goalValidator->food($goal);
        $update = $this->_goalRepository->update($id, $goal);
        return $update;
    }
}
