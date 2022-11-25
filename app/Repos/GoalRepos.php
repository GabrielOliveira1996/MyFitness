<?php

namespace App\Repos;

use Illuminate\Http\Request;
use App\Contracts\IGoalRepos;
use App\Models\Goal;

class GoalRepos implements IGoalRepos{

    private $_request;
    private $_goalRepos;

    public function __construct(Request $request, Goal $goalRepos){

        $this->_request = $request;
        $this->_goalRepos = $goalRepos;
    }

    public function allGoalRepos(){

        $goalFoods = $this->_goalRepos->all();

        return $goalFoods;
    }

    public function goalFoodOfTheDayRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $goalFoods = $this->_goalRepos->where('date', $currentDate)->where('user_id', auth()->user()->id)->paginate(10);

        return $goalFoods;
    }
    
    public function addFoodToDayGoalRepos($data){

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');

        $food = $this->_goalRepos->create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'name' => $data['name'],
            'quantity_grams' => $data['quantity_grams'],
            'calories' => $data['calories'],
            'carbohydrate' => $data['carbohydrate'],
            'protein' => $data['protein'],
            'total_fat' => $data['total_fat'],
            'saturated_fat' => $data['saturated_fat'],
            'trans_fat' => $data['trans_fat'],
            'date' => date('m/d/y')
        ]);

        return $food;

    }

    public function findFoodRepos($id){

        $food = $this->_goalRepos->find($id);
        
        return $food;
    }

    public function updateFoodToDayGoalRepos($id){

        $data = $this->_request->all();

        $food = $this->_goalRepos->where('id', $id)->update([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'name' => $data['name'],
            'quantity_grams' => $data['quantity_grams'],
            'calories' => $data['calories'],
            'carbohydrate' => $data['carbohydrate'],
            'protein' => $data['protein'],
            'total_fat' => $data['total_fat'],
            'saturated_fat' => $data['saturated_fat'],
            'trans_fat' => $data['trans_fat']
        ]);

        return $food;
    }

    public function deleteGoalFoodRepos($id){

        $deleteFoodGoal = $this->_goalRepos->delete($id);

        return $deleteFoodGoal;
        
    }
    
}