<?php

namespace App\Repos;

use App\Contracts\IFoodRepos;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodRepos implements IFoodRepos{

    private $_request;
    private $_food;

    public function __construct(Request $request, Food $food){

        $this->_request = $request;
        $this->_food = $food;

    }

    public function createFoodRepos($user, $data){

        $food = $this->_food->create([
            'user_id' => $user->id,
            'user_name' => $user->name,
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

    public function findFoodRepos($id){

        $food = $this->_food->find($id);
        
        return $food;
    }

    public function updateFoodRepos($id){

        $data = $this->_request->all();

        $food = $this->_food->where('id', $id)->update([
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

    public function deleteFoodRepos($id){

        $food = $this->_food->find($id)->delete();
        
        return $food;
    }

    public function allFoodsRepos(){

        $allFoods = $this->_food->paginate(10);

        return $allFoods;
    }

}