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

    public function get($id){
        return $this->_post->where('id', $id)->first();
    }

    public function delete($id){
        return $this->_post->find($id)->delete();
    }

    public function update($id, $data){
        return $this->_post->where('id', $id)->update([
            'text' => $data['text'],
        ]);
    }
}
