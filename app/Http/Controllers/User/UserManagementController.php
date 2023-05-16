<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserManagementController extends Controller
{
    private $_request;
    private $_userService;

    public function __construct(Request $request, UserService $userService)
    {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_userService = $userService;
    }

    public function updateProfile()
    {
        $user = $this->_request->only([
            'gender',
            'age',
            'weight',
            'stature',
            'activity_rate_factor',
            'objective',
            'type_of_diet',
            'imc',
            'water',
            'basal_metabolic_rate',
            'daily_calories',
            'daily_protein',
            'daily_carbohydrate',
            'daily_fat',
            'daily_protein_kcal',
            'daily_carbohydrate_kcal',
            'daily_fat_kcal'
        ]);
        $update = $this->_userService->update($user);
        return redirect()->route('profile');
    }
}
