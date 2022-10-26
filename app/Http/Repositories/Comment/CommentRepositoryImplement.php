<?php

namespace App\Http\Repositories\Comment;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Comment;

class CommentRepositoryImplement extends Eloquent implements CommentRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
