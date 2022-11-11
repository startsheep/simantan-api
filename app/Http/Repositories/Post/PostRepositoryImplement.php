<?php

namespace App\Http\Repositories\Post;

use App\Models\Like;
use App\Models\Post;
use LaravelEasyRepository\Implementations\Eloquent;

class PostRepositoryImplement extends Eloquent implements PostRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     *
     * @property Model|mixed $model;
     */
    protected $model;

    protected $like;

    public function __construct(Post $model, Like $like)
    {
        $this->like = $like;
        $this->model = $model;
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

    public function updateLike($id)
    {
        $like = $this->like->where([
            'post_id' => $id,
            'user_id' => auth()->user()->id
        ])->first();

        if ($like) {
            return $this->like->where('id', $like->id)->delete();
        } else {
            return $this->like->create([
                'post_id' => $id,
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function countLike($id)
    {
        $likes = $this->like->where('post_id', $id)->get()->count();

        return $likes;
    }
}
