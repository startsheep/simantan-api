<?php

namespace App\Http\Repositories\User;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     *
     * @property Model|mixed $model;
     */
    protected $model, $post, $like;

    public function __construct(User $model, Post $post, Like $like)
    {
        $this->model = $model;
        $this->post = $post;
        $this->like = $like;
    }

    public function whereNip($nip)
    {
        return $this->model->where('nip', $nip)->first();
    }

    public function countPost($id)
    {
        $posts = $this->post->where('user_id', $id)->get()->count();

        return $posts;
    }

    public function countLike($id)
    {
        $likes = $this->like->where('user_id', $id)->get()->count();

        return $likes;
    }
}
