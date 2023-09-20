<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidatorException;
use Illuminate\Validation\ValidationException;

class UserValidator
{
    public function register($user)
    {
        $rules = [
            'name' => 'required|alpha_num',
            'nickname' => 'required|unique:users,nickname',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/',
            'confirm_terms' => 'required|boolean'
        ];

        $messages = [
            'password.regex' => 'The password field format is invalid. The password must contain at least one uppercase letter, one lowercase letter, one number and one special character.'
        ];
        $validator = Validator::make($user, $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return $errors;
        }
    }

    public function update($user)
    {
        $rules = [
            'gender' => 'required|alpha_num',
            'age' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'stature' => 'required|numeric|min:0',
            'activity_rate_factor' => 'required|numeric|min:0',
            'objective' => 'required|numeric',
            'type_of_diet' => 'required|numeric',
            'imc' => 'required|numeric|min:0',
            'water' => 'required|numeric|min:0',
            'daily_calories' => 'required|numeric|min:0',
            'daily_protein' => 'required|numeric|min:0',
            'daily_carbohydrate' => 'required|numeric|min:0',
            'daily_fat' => 'required|numeric|min:0',
            'daily_protein_kcal' => 'required|numeric|min:0',
            'daily_carbohydrate_kcal' => 'required|numeric|min:0',
            'daily_fat_kcal' => 'required|numeric|min:0'
        ];
        $validator = Validator::make($user, $rules);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return $errors;
        }
    }

    public function resetPassword($user)
    {
        $rules = [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
        $messages = [
            'password.regex' => 'The password field format is invalid. The password must contain at least one uppercase letter, one lowercase letter, one number and one special character.'
        ];
        $validator = Validator::make($user, $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->messages();
            throw new ValidatorException(
                'Fields were not filled in, check if the request receives data.',
                422,
                null,
                $errors,
                $user
            );
        }
    }
}
