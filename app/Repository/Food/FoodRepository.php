<?php

namespace App\Repository\Food;

use App\Repository\Food\IFoodRepository;
use App\Models\Food;
use Illuminate\Support\Facades\DB;

class FoodRepository implements IFoodRepository
{
    private $_food;

    public function __construct(Food $food){
        $this->_food = $food;
    }

    public function index($userId){
        return $this->_food->where('user_id', $userId)->get();
    }
    /*
    public function index($search, $data){
        return $this->_food->where($search, $data)->get();
    }*/

    public function create($food, $user){
        return $this->_food->create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'name' => $food['name'],
            'quantity_grams' => $food['quantity_grams'],
            'calories' => $food['calories'],
            'carbohydrate' => $food['carbohydrate'],
            'protein' => $food['protein'],
            'total_fat' => $food['total_fat'],
            'saturated_fat' => $food['saturated_fat'],
            'trans_fat' => $food['trans_fat']
        ]);
    }

    public function find($id, $userId){
        return $this->_food->where('id', $id)->where('user_id', $userId)->get();
    }

    public function update($food, $user){
        return $this->_food->where('id', $food['id'])->update([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'name' => $food['name'],
            'quantity_grams' => $food['quantity_grams'],
            'calories' => $food['calories'],
            'carbohydrate' => $food['carbohydrate'],
            'protein' => $food['protein'],
            'total_fat' => $food['total_fat'],
            'saturated_fat' => $food['saturated_fat'],
            'trans_fat' => $food['trans_fat']
        ]);
    }

    public function delete($id){
        return $this->_food->where('id', $id)->delete();
    }

    public function search($id, $food){
        return $this->_food->where('user_id', $id)->where([['name', 'like', '%' . $food . '%']])->get();
    }
    
    public function searchByName($food){
        return $this->_food->where([['name', 'like', '%' . $food . '%']])->get();
    }

    public function findUserFood($foodId, $userId){
        return $this->_food->where('id', $foodId)->where('user_id', $userId)->get();
    }
}
