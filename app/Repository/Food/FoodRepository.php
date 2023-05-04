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

    public function createFoodRepos($user, $data)
    {
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

    public function findFoodRepos($id)
    {

        $food = $this->_food->where('id', $id)->first();

        return $food;
    }

    public function updateFoodRepos($user, $id)
    {

        $data = $this->_request->all();

        $food = $this->_food->where('id', $id)->update([
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

    public function deleteFoodRepos($id)
    {

        $food = $this->_food->find($id);

        if ($food == null) {

            $food = false;
        } else {

            $food->delete();
            $food = true;
        }

        return $food;
    }

    public function allFoodsRepos()
    {

        $allFoods = $this->_food->paginate(10);

        return $allFoods;
    }

    public function searchFoodRepos($data)
    {

        $search = $this->_food->where([['name', 'like', '%' . $data['name'] . '%']])->paginate(10);

        return $search;
    }
}
