<?php

namespace App\Repository\Food;

use App\Repository\Food\IFoodRepository;
use App\Models\Food;

class FoodRepository implements IFoodRepository
{
    private $_food;

    public function __construct(Food $food)
    {
        $this->_food = $food;
    }

    public function index()
    {
        return $this->_food->paginate(10);
    }

    public function wherePaginate($search, $data)
    {
        return $this->_food->where($search, $data)->paginate(10);
    }

    public function create($food, $user)
    {
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

    public function find($id)
    {
        return $this->_food->find($id);
    }

    public function update($id, $food, $user)
    {
        return $this->_food->where('id', $id)->update([
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

    public function delete($id)
    {
        return $this->_food->find($id)->delete();
    }

    public function search($id, $food)
    {
        return $this->_food->where('user_id', $id)->where([['name', 'like', '%' . $food . '%']])->paginate(12);
    }
}
