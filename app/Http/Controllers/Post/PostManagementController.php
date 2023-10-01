<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Post\IPostRepository;
use Exception;

class PostManagementController extends Controller
{
    private $_request;
    private $_postRepository;

    public function __construct(Request $request, IPostRepository $postRepository){
        $this->_request = $request;
        $this->_postRepository = $postRepository;
    }

    public function create(){
        $post = $this->_request->only('text');
        $create = $this->_postRepository->create(Auth::user(), $post);
        return redirect()->back();
    }
}
