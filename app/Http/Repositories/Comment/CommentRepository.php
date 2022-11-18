<?php

namespace App\Http\Repositories\Comment;

use LaravelEasyRepository\Repository;

interface CommentRepository extends Repository
{
    public function commentCount($id);
}
