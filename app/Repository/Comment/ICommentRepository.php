<?php

namespace App\Repository\Comment;

interface ICommentRepository
{
    public function create($user, $comment);
    public function getAll($nickname);
    public function get($id);
    public function delete($id);
    public function update($id, $data);
}
