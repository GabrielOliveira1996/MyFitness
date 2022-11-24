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

    public function createFoodView(){

        return view('food.create');
    }  

    public function createFood(){
        
        $data = $this->_request->all();
        
        $foodValidate = $this->_foodService->FoodValidate($data);
        
        $foodCreation = $this->_foodRepos->createFoodRepos($data);

        return redirect()->route('home');

    }

    public function userListFoodView(){

        $userlistFood = $this->_foodRepos->userListFoodRepos();

        return view('food.userList', compact('userlistFood'));

    }


    public function searchFoodView(){

        return view('food.search');
    }

    public function searchFood(){

        $data = $this->_request->all();

        //$search = $this->_foodRepos->searchFoodRepos($data);
        //Product::where([['bar_code', 'like', '%'.$barcode.'%']])->paginate(10);

        return redirect()->route('food.search');

    }
}
