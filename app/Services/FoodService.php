<?php

namespace App\Services;

use Illuminate\Http\Request;

class FoodService{

    private $_request;

    public function __construct(Request $request){

        $this->_request = $request;

    }

    public function FoodValidate($data){

        $rules = [
            'name' => 'required',
            'protein' => 'required',
            'carbohydrate' => 'required',
            'saturated_fat' => 'required',
            'monounsaturated_fat' => 'required',
            'polyunsaturated_fat' => 'required'
        ];
        
        $messages = [
            'name.required' => 'Digite o nome do alimento.',
            'protein.required' => 'Digite a quantidade de proteínas.',
            'carbohydrate.required' => 'Digite a quantidade de carboidratos.',
            'saturated_fat.required' => 'Digite a quantidade de de gordura saturada.',
            'monounsaturated_fat.required' => 'Digite a quantidade de gordura monoinsaturada.',
            'polyunsaturated_fat.required' => 'Digite a quantidade de gordura poli-insaturada.'
        ];

        $validated = $this->_request->validate($rules, $messages);

        return $validated;
    }

}