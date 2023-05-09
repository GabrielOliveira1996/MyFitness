<?php

namespace App\Http\Controllers\Food;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    private $_request;
    private $_foodService;

    public function __construct(Request $request, FoodService $foodService)
    {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodService = $foodService;
    }

    public function indexUserFoods()
    {
        $foods = $this->_foodService->indexUserFoods();
        return view('food.all', compact('foods'));
    }

    public function create()
    {
        return view('food.create');
    }

    public function update($id)
    {
        $food = $this->_foodService->find($id);
        return view('food.update', compact('food'));
    }
}
