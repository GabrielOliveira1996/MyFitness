<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Contracts\IFoodRepos;
use App\Http\Controllers\Controller;
//use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;


class FoodControllerAPI extends Controller
{

    private $_request;
    private $_foodService;
    private $_foodRepos;

    public function __construct(Request $request, FoodService $foodService, IFoodRepos $foodRepos){

        //$this->middleware('auth:sanctum');
        $this->_request = $request;
        $this->_foodService = $foodService;
        $this->_foodRepos = $foodRepos;
        
    }

    public function allFoods(){

        $foods = $this->_foodRepos->allFoodsRepos();

        return response()->json($foods);
    }

    public function createFood(){
        
        $data = $this->_request->all();
        $user = Auth::user();
        $foodValidate = $this->_foodService->FoodValidate($data);
        
        if(!$foodValidate){

            $foodCreation = $this->_foodRepos->createFoodRepos($user, $data);

            return response()->json($foodCreation);
        }else{

            return response()->json($foodValidate);
        }
         
    }

    public function updateFood($id){

        $data = $this->_request->all();
        $user = Auth::user();
        $foodValidate = $this->_foodService->FoodValidate($data);

        if(!$foodValidate){

            $foodUpdate = $this->_foodRepos->updateFoodRepos($user, $id);

            return response()->json($foodUpdate);
        }else{

            return response()->json($foodValidate);
        }

    }

    public function deleteFood($id){

        $food = $this->_foodRepos->deleteFoodRepos($id);
        
        if($food == false){
            
            return response()->json('Alimento não localizado.');
        }else{

            return response()->json('Alimento excluído com sucesso.');
        }
        
    }

}
