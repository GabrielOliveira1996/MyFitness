<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Contracts\IFoodRepos;
use App\Http\Controllers\Controller;


class FoodControllerAPI extends Controller
{

    private $_request;
    private $_foodService;
    private $_foodRepos;

    public function __construct(Request $request, FoodService $foodService, IFoodRepos $foodRepos){

        $this->middleware('auth:sanctum');
        $this->_request = $request;
        $this->_foodService = $foodService;
        $this->_foodRepos = $foodRepos;

    }

    public function allFoods(){

        $foods = $this->_foodRepos->allFoodsRepos();

        return response()->json($foods);
    }


}
