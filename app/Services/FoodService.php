<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodService{

    private $_request;

    public function __construct(Request $request){

        $this->_request = $request;

    }

    public function FoodValidate($data){

        $rules = [
            'name' => 'required',
            'quantity_grams' => 'required',
            'calories' => 'required',
            'carbohydrate' => 'required',
            'protein' => 'required',
            'total_fat' => 'required',
            'saturated_fat' => 'required',
            'trans_fat' => 'required'
        ];
        
        $messages = [
            'name.required' => 'Digite o nome do alimento.',
            'quantity_grams.required' => 'Digite a quantidade de quantidade de gramas.',
            'calories.required' => 'Digite a quantidade de calorias.',
            'carbohydrate.required' => 'Digite a quantidade de carboidratos.',
            'protein.required' => 'Digite a quantidade de proteínas.',
            'total_fat.required' => 'Digite a quantidade de gordura total.',
            'saturated_fat.required' => 'Digite a quantidade de de gordura saturada.',
            'trans_fat.required' => 'Digite a quantidade de de gordura trans.'
        ];

        $validator = Validator::make($this->_request->all(), $rules, $messages);

        if ($validator->fails()){
            
            return $validator->messages();
        }
    }

}