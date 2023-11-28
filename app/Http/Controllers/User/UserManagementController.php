<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Validator\UserValidator;
use App\Repository\User\IUserRepository;
use App\Repository\Follower\IFollowerRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailProvider;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Exception;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Storage;


class UserManagementController extends Controller
{
    private $_request;
    private $_userService;
    private $_userValidator;
    private $_userRepository;
    private $_mailProvider;
    private $_timezone;

    public function __construct(
        Request $request, 
        UserService $userService,  
        UserValidator $userValidator, 
        IUserRepository $userRepository,
        IFollowerRepository $followerRepository,
        MailProvider $mailProvider)
    {
        $this->_request = $request;
        $this->_userService = $userService;
        $this->_userValidator = $userValidator;
        $this->_userRepository = $userRepository;
        $this->_followerRepository = $followerRepository;
        $this->_mailProvider = $mailProvider;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function updateProfile()
    {
        try{
            $this->middleware('auth');
            $id = Auth::user()->id;
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
            $validator = $this->_userValidator->update($user);
            if($validator != null){
                throw new Exception(json_encode($validator->messages()), 422); // Unprocessable Entity.
            }
            $update = $this->_userRepository->update($user, $id);
            return redirect()->route('goal.index');
        }catch(Exception $e){
            $errors = json_decode($e->getMessage(), true);
            return redirect()->back()->withErrors($errors);
        }
    }

    public function register(){
        try{
            $user = $this->_request->only([
                'name',
                'nickname',
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
            $validator = $this->_userValidator->register($user);
            if($validator != null){
                throw new Exception(json_encode($validator->messages()), 422); // Unprocessable Entity.
            }
            $register = $this->_userRepository->create($user);
            $token = $register->createToken('auth_token')->plainTextToken;
            Auth::login($register);
            return redirect()->route('welcome');
        }catch(Exception $e){
            $errors =json_decode($e->getMessage(), true);
            return redirect()->back()->withErrors($errors);
        }
    }

    public function login(){
        try{
            $credentials = $this->_request->only(['email', 'password']);
            if(Auth::attempt($credentials)) {
                if ($this->_request->hasSession()) {
                    $this->_request->session()->put('auth.password_confirmed_at', time());
                    $token = Auth::user()->createToken('auth_token')->plainTextToken;
                }
                return response()->json(['token' => $token], 200);
            }
            throw new Exception('Usuário não foi encontrado em nossos registros.', 422);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function logout(){
        $this->middleware('auth');
        Auth::logout();
        $this->_request->session()->invalidate();
        $this->_request->session()->regenerateToken();
        return redirect('/');
    }

    public function sendEmailToRecoverPassword(){ // Precisa verificar se é uma conta google.
        try{
            $email = $this->_request->only(['email']);
            $user = $this->_userRepository->findUserByEmail($email);
            if($user){ // Verifica se usuário foi localizado.
                if($user['google_id']){
                    throw new Exception('Você é um usuário do Google. Use sua conta do Gmail para fazer login.');
                }
                $this->_mailProvider->recoverPassword($user);
                $messages = $this->_request->session()->get('errors')->all();
                return back()->with(['status' => $messages[0]]);
            }
            throw new Exception('E-mail inválido.', 422);
        }catch(Exception $e){
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function resetPassword(){
        try{
            $user = $this->_request->only(['token', 'email', 'password', 'password_confirmation']);
            $validator = $this->_userValidator->resetPassword($user);
            $findUser = $this->_userRepository->findUserByEmail($user['email']);
            if($findUser){
                if($validator != null){
                    throw new Exception(json_encode($validator->messages()), 422); // Unprocessable Entity.
                }
                $status = Password::reset(
                    $user,
                    function (User $user, string $password) {
                        $user->forceFill([
                            'password' => Hash::make($password)
                        ])->setRememberToken(Str::random(60));
                        $user->save();
                        event(new PasswordReset($user));
                    }
                );
                if($status !== Password::PASSWORD_RESET){
                    throw new Exception(json_encode($status), 422); // Unprocessable Entity.
                }
                return redirect()->route('login')->with('status', __($status));
            }
            throw new Exception(json_encode(['email' => 'E-mail inválido.']), 422);
        }catch(Exception $e){
            $status = json_decode($e->getMessage(), true);
            return back()->withErrors($status);
        }
    }

    public function publicProfileUpdate(){ 
        try{
            $this->middleware('auth');
            $user = Auth::user();
            $data = $this->_request->only(['name', 'nickname', 'bio']);
            $rules = [
                'name' => 'required',
                'bio' => 'required'
            ];
            if($user['nickname'] != $data['nickname']){
                $rules['nickname'] = 'required|unique:users,nickname';
            }
            $validator = \Validator::make($data, $rules);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            if($user['name'] === $data['name'] && 
                $user['nickname'] === $data['nickname'] && 
                $user['bio'] === $data['bio']){
                throw new Exception('Não existe nada para ser salvo.');
            }
            $update = $this->_userRepository->publicSettingsUpdate($data, $user->id);
            return redirect()->route('user.settings')->with('success', 'Alterações realizadas com sucesso.');
        }catch(Exception $e){
            return redirect()->route('user.settings')->with('unsuccessfully', $e->getMessage());
        }
    }

    public function uploadProfileImage(){
        try{
            $this->middleware('auth');
            $user = Auth::user();
            $file = $this->_request->file('profile_image');
            $rules = [
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ];
            $validator = \Validator::make([
                'profile_image' => $file
            ], $rules);
            if($validator->fails()){
                throw new Exception($validator->errors()->first());
            }
            $deletePreviousImage = Storage::delete($user->profile_image);
            $path = $file->store('profile');
            $user = ['id' => $user->id, 'profile_image' => $path];
            $updateProfileImage = $this->_userRepository->profileImageUpdate($user);
            return redirect()->route('user.settings')->with('success', 'Imagem de perfil foi atualizada com sucesso.');
        }catch(Exception $e){
            return redirect()->route('user.settings')->with('unsuccessfully', $e->getMessage());
        }
    }
    
    public function searchUsers(){
        try{
            $user = Auth::user();
            $name = $this->_request->input('name');
            $users = $this->_userRepository->searchUser($name, $user->id);
            if(count($users) === 0){
                throw new Exception('Nenhum usuário encontrado.', 404);
            }
            return view('community.users', compact('users'));
        }catch(Exception $e){
            $error = session()->put('searchUserFailure', $e->getMessage());
            return view('community.users');
        }
    }

    public function followUser($nickname){
        try{
            $authUser = Auth::user();
            $userNicknameToFollow = $this->_userRepository->searchUserByNickname($nickname);
            if(Auth::user()->following()->where('user_id', $userNicknameToFollow->id)->exists()){
                throw new Exception("Você já está seguindo $nickname.", 409); // Conflict
            }
            $this->_followerRepository->followUser($authUser, $userNicknameToFollow->id);
            return back()->with('status', "Agora você está seguindo $nickname.");
        }catch(Exception $e){
            return back()->with('status', $e->getMessage());
        }
    }

    public function unfollowUser($nickname){
        try{
            $authUser = Auth::user();
            $userNicknameToUnfollow = $this->_userRepository->searchUserByNickname($nickname);
            if($userNicknameToUnfollow){
                $this->_followerRepository->unfollowUser($authUser, $userNicknameToUnfollow->id);
            }
            return back()->with('status', "Você parou de seguir $nickname.");
        }catch(Exception $e){
            return back()->with('status', $e->getMessage());
        }
    }
}
