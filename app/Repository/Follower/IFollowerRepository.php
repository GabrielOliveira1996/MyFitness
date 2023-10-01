<?php

namespace App\Repository\Follower;

interface IFollowerRepository
{
    public function followUser($nickname, $userNicknameToFollowId);
    public function unfollowUser($authUser, $userNicknameToUnfollowId);
    public function getAllFollowers($authUser);
}
