<?php

namespace App\Repository\Post;

interface IPostRepository
{
    public function create($user, $post);
    public function getAll($nickname);
    public function get($id);
    public function delete($id);
    public function update($id, $data);
}
