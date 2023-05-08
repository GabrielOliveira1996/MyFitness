<?php

namespace App\Repository\User;

interface IUserRepository
{
    public function create($user);
    public function update($user, $id);
    public function find($id);
}
