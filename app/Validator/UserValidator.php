<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidatorException;

class UserValidator
{
    public function register($user)
    {
        $rules = [
            'name' => 'required|alpha_num',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/',
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
                $errors
            );
        }
    }
}
