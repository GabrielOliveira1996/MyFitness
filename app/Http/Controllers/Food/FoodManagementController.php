<?php

namespace App\Http\Controllers\Food;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Food\IFoodRepository;
use Illuminate\Support\Facades\Auth;
use App\Validator\FoodValidator;

class FoodManagementController extends Controller
{
    private $_request;
    private $_foodRepository;
    private $_foodValidator;

    public function __construct(Request $request, IFoodRepository $foodRepository,FoodValidator $foodValidator){
        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodRepository = $foodRepository;
        $this->_foodValidator = $foodValidator;
    }

    public function create(){
        try{ 
            $user = Auth::user();
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
            if(!$food){
                throw new Exception('Não existem dados passados pelo usuário.', 404);
            }
            $create = $this->_foodRepository->create($food, $user);
            return redirect()->route('food.all');
        }catch(\Exception $e){
            return back()->with('unsuccessfully', $e->getMessage());
        }
    }

    public function delete($id){
        try{
            $user = Auth::user();
            $get = $this->_foodRepository->findUserFood($id, $user['id']);
            if(count($get) === 0){
                throw new \Exception('Seu alimento não foi localizado.', 404); //
            }
            $delete = $this->_foodRepository->delete($id);
            return redirect()->route('food.all');
        }catch(\Exception $e){
            return back()->with('unsuccessfully', $e->getMessage());
        }   
    }

    public function update(){
        try{ 
            $user = Auth::user();
            $food = $this->_request->only([
                'id',
                'name',
                'quantity_grams',
                'calories',
                'carbohydrate',
                'protein',
                'total_fat',
                'saturated_fat',
                'trans_fat'
            ]);
            $get = $this->_foodRepository->find($food['id'], $user['id']);
            if(empty($get)){
                throw new \Exception('Seu alimento não foi localizado.', 404); //
            }
            $update = $this->_foodRepository->update($food, $user);
            return redirect()->route('food.all');
        }catch(\Exception $e){
            return back()->with('unsuccessfully', $e->getMessage());
        }
    }

    public function search(){
        try{
            $id = Auth::user()->id;
            $food = $this->_request->input('name');
            $foods = $this->_foodRepository->search($id, $food);
            if(empty($users->$foods)){
                throw new \Exception('Alimento não encontrado.');
            }
            return view('food.all', compact('foods'));
        }catch(\Exception $e){
            return redirect()->route('food.all')->with('unsuccessfully', $e->getMessage());
        }
    }
}
