<?php

namespace App\Repository\Comment;

use App\Repository\Comment\ICommentRepository;
use App\Models\Comment;

class CommentRepository implements ICommentRepository
{
    private $_comment;

    public function __construct(Comment $comment){
        $this->_comment = $comment;
    }

    public function create($user, $comment){
        return $this->_comment->create([
            'user_id' => $user['id'],
            'post_id' => $comment['post_id'],
            'comment_id' => null,
            'text' => $comment['text']
        ]);
    }

    public function getAll($id){
        return $this->_comment->where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
    }

    public function get($id){
        return $this->_comment->where('id', $id)->first();
    }

    public function delete($id){
        return $this->_comment->find($id)->delete();
    }

    public function update($data){
        return $this->_comment->where('id', $data['id'])->update([
            'text' => $data['text'],
        ]);
    }
}
