<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Validator\UserValidator;;
use App\Repository\User\IUserRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailProvider;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class UserManagementController extends Controller
{
    private $_request;
    private $_userService;
    private $_userValidator;
    private $_userRepository;
    private $_mailProvider;

    public function __construct(
        Request $request, 
        UserService $userService,  
        UserValidator $userValidator, 
        IUserRepository $userRepository,
        MailProvider $mailProvider)
    {
        $this->_request = $request;
        $this->_userService = $userService;
        $this->_userValidator = $userValidator;
        $this->_userRepository = $userRepository;
        $this->_mailProvider = $mailProvider;
    }

    public function updateProfile()
    {
        $this->middleware('auth');
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

    public function register(){
        $user = $this->_request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
            'confirm_terms',
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
        $this->_userValidator->register($user);
        $this->_userRepository->create($user);
        return redirect()->route('login');
    }

    public function login(){
        $credentials = $this->_request->only(['email', 'password']);
        if(Auth::attempt($credentials)) {
            if ($this->_request->hasSession()) {
                $this->_request->session()->put('auth.password_confirmed_at', time());
            }
            return redirect()->route('welcome');
        }
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(){
        $this->middleware('auth');
        Auth::logout();
        $this->_request->session()->invalidate();
        $this->_request->session()->regenerateToken();
        return redirect('/');
    }

    public function sendEmailToRecoverPassword(){
        try{
            $this->_request->validate(['email' => 'required|email']);
            $user = $this->_userRepository->findUserByEmail($this->_request->email);
            if($user){
                $this->_mailProvider->recoverPassword($user);
                return back()->with(['status' => 'Por favor, verifique o seu e-mail.']);
            } 
            throw new EmailSendingException('Erro no envio do e-mail.');
        }catch(EmailSendingException $e){
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function resetPassword(){
        $user = $this->_request->only(['token', 'email', 'password', 'password_confirmation']);
        $validate = $this->_userValidator->resetPassword($user);
        $status = $this->_userService->resetPassword($user);
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
