<?php

namespace App\Repository\Post;

use App\Repository\Post\IPostRepository;
use App\Models\Post;

class PostRepository implements IPostRepository
{
    private $_post;

    public function __construct(Post $post){
        $this->_post = $post;
    }

    public function create($user, $post){
        return $this->_post->create([
            'user_id' => $user->id,
            'text' => $post['text']
        ]);
    }

    public function getAll($id){
        return $this->_post->where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
    }
}
