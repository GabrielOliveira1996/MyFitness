<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidatorException;

class GoalValidator
{
    public function food($goal)
    {
        $rules = [
            'name' => 'required',
            'quantity_grams' => 'required|numeric|min:1',
            'calories' => 'required|numeric|min:0',
            'carbohydrate' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'total_fat' => 'required|numeric|min:0',
            'saturated_fat' => 'required|numeric|min:0',
            'trans_fat' => 'required|numeric|min:0',
            'type_of_meal' => 'required|alpha'
        ];

        $validator = Validator::make($goal, $rules);
        if ($validator->fails()) {
            $errors = $validator->messages();
            dd($errors);
            throw new ValidatorException(
                'Fields were not filled in, check if the request receives data.',
                422,
                null,
                $errors
            );
        }
    }
}
