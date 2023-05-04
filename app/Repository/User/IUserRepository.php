<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\User\IUserRepository;

class UserRepository implements IUserRepository
{
    private $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function create($user): User
    {
    }
}
