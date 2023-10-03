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

    public function indexUserFoods(){
        try{
            $foods = $this->_foodService->indexUserFoods();
            if(empty($foods->items())){
                throw new \Exception('Nenhum alimento foi encontrado. Clique no botão acima para adicionar um alimento a sua lista.', 404);
            }
            return view('food.all', compact('foods'));
        }catch(\Exception $e){
            $unsuccessfully = $e->getMessage();
            return view('food.all', compact('unsuccessfully'));
        }
    }

    public function update($id){
        $food = $this->_foodService->find($id);
        return view('food.update', compact('food'));
    }
}
