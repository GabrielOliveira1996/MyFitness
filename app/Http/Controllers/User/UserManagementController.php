<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Validator\UserValidator;;
use App\Repository\User\IUserRepository;
use Illuminate\Validation\ValidationException;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    private $_request;
    private $_userService;
    private $_userValidator;
    private $_userRepository;

    public function __construct(
        Request $request, 
        UserService $userService,  
        UserValidator $userValidator, 
        IUserRepository $userRepository)
    {
        $this->_request = $request;
        $this->_userService = $userService;
        $this->_userValidator = $userValidator;
        $this->_userRepository = $userRepository;
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
        dd('hehe');
        /*
        $email = $this->_request->only(['email']);
        dd($email);
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new TransactionalEmailsApi(null, $config);
        $email = new SendSmtpEmail([
            'to' => [['email' => $email]],
            'subject' => 'Assunto do e-mail',
            'htmlContent' => '<p>Conteúdo do e-mail em HTML</p>',
            'sender' => ['email' => 'myfitness.assistance@gmail.com', 'name' => 'MyFitness'],
        ]);
        $result = $apiInstance->sendTransacEmail($email);
        try {
            // Envie o e-mail usando a API do Sendinblue
            $result = $apiInstance->sendTransacEmail($email);
            // Lógica para lidar com o resultado, se necessário
            // ...
        } catch (Exception $e) {
            // Trate exceções, se ocorrer algum erro no envio
            // ...
        }*/
    }
}
