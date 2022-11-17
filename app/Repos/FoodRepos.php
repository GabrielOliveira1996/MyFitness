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
    
    public function createFoodRepos($data){

        $food = $this->_food->create([
            'name' => $data['name'],
            'calories' => $data['calories'],
            'protein' => $data['protein'],
            'carbohydrate' => $data['carbohydrate'],
            'saturated_fat' => $data['saturated_fat'],
            'monounsaturated_fat' => $data['monounsaturated_fat'],
            'polyunsaturated_fat' => $data['polyunsaturated_fat']
        ]);
        
        return $food;
    }

}