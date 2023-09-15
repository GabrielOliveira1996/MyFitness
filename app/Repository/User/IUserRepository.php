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
    public function publicSettingsUpdate($user, $id);
    public function searchUser($user, $idAuthUser);
    public function searchUserByNickname($nickname);
    public function followUser($nickname, $userNicknameToFollowId);
    public function unfollowUser($authUser, $userNicknameToUnfollowId);
}
