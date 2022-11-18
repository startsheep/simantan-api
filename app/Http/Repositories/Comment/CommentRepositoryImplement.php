<?php

namespace App\Http\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Http\Response;
use LaravelEasyRepository\Implementations\Eloquent;

class CommentRepositoryImplement extends Eloquent implements CommentRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     *
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function commentCount($id)
    {
        $countLike = $this->model->where('id', $id)->get()->count();

        return $countLike;
    }
}
