<?php

namespace App\Repository\Follower;

use App\Repository\Follower\IFollowerRepository;
use App\Models\Follower;
use Illuminate\Support\Facades\Hash;

class FollowerRepository implements IFollowerRepository
{
    private $_follower;

    public function __construct(Follower $follower){
        $this->_follower = $follower;
    }

    public function followUser($authUser, $userNicknameToFollowId){
        return $authUser->following()->attach($userNicknameToFollowId);
    }

    public function unfollowUser($authUser, $userNicknameToUnfollowId){
        return $authUser->following()->detach($userNicknameToUnfollowId);
    }

    public function getAllFollowers($authUser){
        return $authUser->following;
    }
}
