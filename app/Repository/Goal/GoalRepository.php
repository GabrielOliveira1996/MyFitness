<?php

namespace App\Repository\Goal;

use App\Repository\Goal\IGoalRepository;
use App\Models\Goal;

class GoalRepository implements IGoalRepository
{
    private $_goalRepos;

    public function __construct(Goal $goalRepos)
    {
        $this->_goalRepos = $goalRepos;
    }

    public function allGoalRepos()
    {

        $goalFoods = $this->_goalRepos->all();

        return $goalFoods;
    }

    //Funções de tipos de refeições///////////////
    public function breakfastGoalFoodsRepos($date)
    {

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = $date;
        //dd($date);
        if (!empty($date)) {

            $breakfastGoalFoods = $this->_goalRepos
                ->where('date', $currentDate)
                ->where('type_of_meal', 'breakfast')
                ->where('user_id', auth()->user()->id)
                ->get();

            return $breakfastGoalFoods;
        }

        $response = collect([
            'calories' => 0,
            'carbohydrate' => 0,
            'protein' => 0,
            'total_fat' => 0
        ]);

        return $response;
    }

    public function lunchGoalFoodsRepos($date)
    {

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = $date;

        if (!empty($date)) {

            $lunchGoalFoods = $this->_goalRepos
                ->where('date', $currentDate)
                ->where('type_of_meal', 'lunch')
                ->where('user_id', auth()->user()->id)
                ->get();

            return $lunchGoalFoods;
        }

        $response = collect([
            'calories' => 0,
            'carbohydrate' => 0,
            'protein' => 0,
            'total_fat' => 0
        ]);

        return $response;
    }

    public function snackGoalFoodsRepos($date)
    {

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = $date;

        if (!empty($date)) {

            $snackGoalFoods = $this->_goalRepos
                ->where('date', $currentDate)
                ->where('type_of_meal', 'snack')
                ->where('user_id', auth()->user()->id)
                ->get();

            return $snackGoalFoods;
        }

        $response = collect([
            'calories' => 0,
            'carbohydrate' => 0,
            'protein' => 0,
            'total_fat' => 0
        ]);

        return $response;
    }

    public function dinnerGoalFoodsRepos($date)
    {

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = $date;

        if (!empty($date)) {

            $dinnerGoalFoods = $this->_goalRepos
                ->where('date', $currentDate)
                ->where('type_of_meal', 'dinner')
                ->where('user_id', auth()->user()->id)
                ->get();

            return $dinnerGoalFoods;
        }

        $response = collect([
            'calories' => 0,
            'carbohydrate' => 0,
            'protein' => 0,
            'total_fat' => 0
        ]);

        return $response;
    }

    public function preWorkoutGoalFoodsRepos($date)
    {

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = $date;

        if (!empty($date)) {

            $preWorkoutGoalFoods = $this->_goalRepos
                ->where('date', $currentDate)
                ->where('type_of_meal', 'pre_workout')
                ->where('user_id', auth()->user()->id)
                ->get();

            return $preWorkoutGoalFoods;
        }

        $response = collect([
            'calories' => 0,
            'carbohydrate' => 0,
            'protein' => 0,
            'total_fat' => 0
        ]);

        return $response;
    }

    public function postWorkoutGoalFoodsRepos($date)
    {

        $timezoneSp = date_default_timezone_set('America/Sao_Paulo');
        $currentDate = $date;

        if (!empty($date)) {

            $postWorkoutGoalFoods = $this->_goalRepos
                ->where('date', $currentDate)
                ->where('type_of_meal', 'post_workout')
                ->where('user_id', auth()->user()->id)
                ->get();

            return $postWorkoutGoalFoods;
        }

        $response = collect([
            'calories' => 0,
            'carbohydrate' => 0,
            'protein' => 0,
            'total_fat' => 0
        ]);

        return $response;
    }

    ///////////////////////////////////////

    public function addFoodToDayGoalRepos($data)
    {

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
            'date' => date('d/m/Y')
        ]);

        return $food;
    }

    public function findFoodRepos($id)
    {

        $food = $this->_goalRepos->find($id);

        return $food;
    }

    public function updateFoodToDayGoalRepos($id)
    {

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
            'trans_fat' => $data['trans_fat'],
            'type_of_meal' => $data['type_of_meal'],
        ]);

        return $food;
    }

    public function deleteGoalFoodRepos($id)
    {

        $deleteFoodGoal = $this->_goalRepos->where('id', $id)->delete();

        return $deleteFoodGoal;
    }

    public function searchGoalRepos($data)
    {

        $explodeDate = explode('-', $data['date']);
        $date = $explodeDate[1] . '/' . $explodeDate[2] . '/' . $explodeDate[0];
        //dd($date);
        $search = $this->_goalRepos->where('date', $date)->get();

        return $search;
    }
}
