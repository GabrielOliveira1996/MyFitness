<?php

namespace App\Http\Controllers\Food;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Http\Controllers\Controller;

class FoodManagementController extends Controller
{
    private $_request;
    private $_foodService;

    public function __construct(Request $request, FoodService $foodService)
    {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodService = $foodService;
    }

    public function create()
    {
        $food = $this->_request->only([
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat'
        ]);
        $create = $this->_foodService->create($food);
        return redirect()->route('food.all');
    }

    public function update($id)
    {
        $food = $this->_request->only([
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat'
        ]);
        $update = $this->_foodService->update($id, $food);
        return redirect()->route('food.all');
    }

    public function delete($id)
    {
        $delete = $this->_foodService->delete($id);
        return redirect()->route('food.all');
    }

    public function searchFood()
    {

        $data = $this->_request->all();

        if (!$data['name'] == null) {

            $foods = $this->_foodRepos->searchFoodRepos($data);

            return view('goal.addFoodToGoal', compact('foods'));
        }

        return view('goal.addFoodToGoal');
    }
}
