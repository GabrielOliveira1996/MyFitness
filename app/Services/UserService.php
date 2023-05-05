<?php

namespace App\Services;

use App\Validator\UserValidator;
use App\Repository\User\IUserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $_userValidator;
    private $_userRepository;

    public function __construct(UserValidator $userValidator, IUserRepository $userRepository)
    {
        $this->_userValidator = $userValidator;
        $this->_userRepository = $userRepository;
    }

    public function register($user)
    {
        $validator = $this->_userValidator->register($user);
        $createUser = $this->_userRepository->create($user);
    }

    public function update($user)
    {
        $id = Auth::user()->id;
        $update = $this->_userRepository->update($user, $id);
        return $update;
    }
}
