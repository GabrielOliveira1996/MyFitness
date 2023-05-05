<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\BasalMetabolicRate;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $settingBasalMetabolic = BasalMetabolicRate::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'gender' => 0,
            'age' => 0,
            'weight' => 0,
            'stature' => 0,
            'activity_rate_factor' => 0,
            'objective' => 0,
            'type_of_diet' => 'Padrão',
            'imc' => 0,
            'water' => 0,
            'basal_metabolic_rate' => 0,
            'daily_calories' => 0,
            'daily_protein' => 0,
            'daily_carbohydrate' => 0,
            'daily_fat' => 0,
            'daily_protein_kcal' => 0,
            'daily_carbohydrate_kcal' => 0,
            'daily_fat_kcal' => 0
        ]);

        return $user;
    }
}
