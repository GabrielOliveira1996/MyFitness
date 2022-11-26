<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Contracts\IFoodRepos;


class FoodController extends Controller
{

    private $_request;
    private $_foodService;
    private $_foodRepos;

    public function __construct(Request $request, FoodService $foodService, IFoodRepos $foodRepos){

        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodService = $foodService;
        $this->_foodRepos = $foodRepos;

    }

    //Views.
    public function createFoodView(){

        return view('food.create');
    }  

    public function allFoodsView(){

        $userFoods = $this->_foodRepos->allFoodsRepos();

        return view('food.all', compact('userFoods'));
    }

    public function updateFoodView($id){
        
        $food = $this->_foodRepos->findFoodRepos($id);
        
        return view('food.update', compact('food'));
    }
    //View não utilizada até o momento.
    public function searchFoodView(){

        return view('food.search');
    }


    //Funções.
    public function createFood(){
        
        $data = $this->_request->all();
        $foodValidate = $this->_foodService->FoodValidate($data);
        $foodCreation = $this->_foodRepos->createFoodRepos($data);

        return redirect()->route('createFoodView');
    }

    public function updateFood($id){

        $userFoods = $this->_foodRepos->allFoodsRepos();
        $food = $this->_foodRepos->updateFoodRepos($id);
        
        return redirect()->route('allFoodsView', compact('userFoods'));
    }
    
    public function deleteFood($id){

        $userFoods = $this->_foodRepos->allFoodsRepos();
        $food = $this->_foodRepos->deleteFoodRepos($id);
        
        return redirect()->route('allFoodsView', compact('userFoods'));
    }

    //Função não utilizadas até o momento.
    public function searchFood(){

        $data = $this->_request->all();

        //$search = $this->_foodRepos->searchFoodRepos($data);
        //Product::where([['bar_code', 'like', '%'.$barcode.'%']])->paginate(10);

        return redirect()->route('food.search');
    }
}
