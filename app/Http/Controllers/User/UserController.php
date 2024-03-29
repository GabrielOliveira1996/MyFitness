<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repository\User\IUserRepository;
use App\Repository\Post\IPostRepository;
use App\Models\Post;
use App\Repository\Follower\IFollowerRepository;

class UserController extends Controller
{
    private $_userRepository;
    private $_postRepository;
    private $_followerRepository;

    public function __construct(IUserRepository $userRepository, IPostRepository $postRepository, IFollowerRepository $followerRepository){
        $this->_userRepository = $userRepository;
        $this->_postRepository = $postRepository;
        $this->_followerRepository = $followerRepository;
        $this->middleware('auth');
    }

    public function index(){
        return view('welcome');
    }

    public function profile(){
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    public function settings(){
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    public function community(){
        $user = Auth::user();
        $followedUserIds = $user->following->pluck('id');
        $posts = Post::where('user_id', $user->id)->orWhereIn('user_id', $followedUserIds)->with('user')->orderBy('created_at', 'desc')->get();
        return view('community.index', compact('user', 'posts'));
    }

    public function userProfile($nickname){
        $user = $this->_userRepository->searchUserByNickname($nickname);
        $posts = $this->_postRepository->getAll($user->id);
        return view('community.user-profile', compact('user', 'posts'));
    }

    public function allFollowers(){
        $user = Auth::user();
        $followers = $this->_followerRepository->getAllFollowers($user);
        //dd($followers);
        return view('community.followers', compact('followers'));
    }
}
