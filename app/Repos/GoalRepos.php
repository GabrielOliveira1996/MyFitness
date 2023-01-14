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

    //Funções de tipos de refeições///////////////
    public function breakfastGoalFoodsRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $breakfastGoalFoods = $this->_goalRepos
                            ->where('date', $currentDate)
                            ->where('type_of_meal', 'breakfast')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return $breakfastGoalFoods;
    }

    public function lunchGoalFoodsRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $lunchGoalFoods = $this->_goalRepos
                            ->where('date', $currentDate)
                            ->where('type_of_meal', 'lunch')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return $lunchGoalFoods;
    }

    public function snackGoalFoodsRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $snackGoalFoods = $this->_goalRepos
                            ->where('date', $currentDate)
                            ->where('type_of_meal', 'snack')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return $snackGoalFoods;
    }

    public function dinnerGoalFoodsRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $dinnerGoalFoods = $this->_goalRepos
                            ->where('date', $currentDate)
                            ->where('type_of_meal', 'dinner')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return $dinnerGoalFoods;
    }

    public function preWorkoutGoalFoodsRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $preWorkoutGoalFoods = $this->_goalRepos
                            ->where('date', $currentDate)
                            ->where('type_of_meal', 'pre_workout')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return $preWorkoutGoalFoods;
    }

    public function postWorkoutGoalFoodsRepos(){
        
        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = date('m/d/y');

        $postWorkoutGoalFoods = $this->_goalRepos
                            ->where('date', $currentDate)
                            ->where('type_of_meal', 'post_workout')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return $postWorkoutGoalFoods;
    }

    ///////////////////////////////////////
    
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
            'type_of_meal' => $data['type_of_meal'],
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

        $deleteFoodGoal = $this->_goalRepos->where('id', $id)->delete();

        return $deleteFoodGoal;
    }
    
}