<?php

namespace App\Http\Services\Comment;

use LaravelEasyRepository\BaseService;

interface CommentService extends BaseService
{
    public function commentCount($id);
}
