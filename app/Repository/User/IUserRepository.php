<?php

namespace App\Repository\User;

interface IUserRepository
{
    public function create($user);
    public function createGoogleUser($user);
    public function update($user, $id);
    public function find($id);
    public function findGoogleUser($email);
    public function findUserByEmail($email);
    public function profileImageUpdate($user);
}
