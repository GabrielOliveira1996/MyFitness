<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidatorException;

class FoodValidator
{
    public function create($food)
    {
        $rules = [
            'name' => 'required',
            'quantity_grams' => 'required|numeric|min:0',
            'calories' => 'required|numeric|min:0',
            'carbohydrate' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'total_fat' => 'required|numeric|min:0',
            'saturated_fat' => 'required|numeric|min:0',
            'trans_fat' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($food, $rules);
        if ($validator->fails()) {
            $errors = $validator->messages();
            throw new ValidatorException(
                'Fields were not filled in, check if the request receives data.',
                422,
                null,
                $errors
            );
        }
    }

    public function update($food)
    {
        $rules = [
            'name' => 'required',
            'quantity_grams' => 'required|numeric|min:0',
            'calories' => 'required|numeric|min:0',
            'carbohydrate' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'total_fat' => 'required|numeric|min:0',
            'saturated_fat' => 'required|numeric|min:0',
            'trans_fat' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($food, $rules);
        if ($validator->fails()) {
            $errors = $validator->messages();
            throw new ValidatorException(
                'Fields were not filled in, check if the request receives data.',
                422,
                null,
                $errors
            );
        }
    }
}
