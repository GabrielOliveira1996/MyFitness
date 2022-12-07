<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserControllerAPI extends Controller
{

    private $_request;

    public function __construct(Request $request){

        $this->_request = $request;

    }

    public function login(){

        if(auth()->attempt(['email' => $this->_request->email, 'password' => $this->_request->password])){
            $user = auth()->user();
            $token = $user->createToken('JWT');
            return response()->json($token->plainTextToken, 200);
        }
        
        return response()->json('Usuário inválido.', 401);
        
    }

    protected function validator(array $data)
    {   
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $messages = [
            'name.required' => 'Nome de usuário não digitado.',
            'name.string' => 'Nome só pode ter letras.',
            'name.max' => 'Nome não pode ser muito longo.',
            'email.required' => 'E-mail não digitado.',
            'email.email' => 'E-mail não é válido para cadastro.',
            'email.max' => 'E-mail não pode ser muito longo.',
            'email.unique' => 'E-mail não é válido para cadastro.',
            'password.required' => 'Senha não digitada.',
            'password.min' => 'Senha precisa ter no mínimo 9 caracteres.',
            'password.confirmed' => 'Senha de confirmação inválida.'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()){

            $errors = $validator->messages();
            return response()->json($errors);
        }

        return true;

    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(){

        $data = $this->_request->all();

        $validate = $this->validator($data);

        if($validate !== true){
      
            return response()->json($validate, 200);
        }
        
        $user = $this->create($data);

        return response()->json($user, 200);

    }
}


