<?php

namespace App\Http\Repositories\Like;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Like;

class LikeRepositoryImplement extends Eloquent implements LikeRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Like $model)
    {
        $this->model = $model;
    }

    public function updateLike($id)
    {
        $like = $this->model->where([
            'post_id' => $id,
            'user_id' => auth()->user()->id
        ])->first();

        if ($like) {
            return $this->model->where('id', $like->id)->delete();
        } else {
            return $this->model->create([
                'post_id' => $id,
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function likeCount($id)
    {
        $likes = $this->model->where('post_id', $id)->get()->count();

        return $likes;
    }

    public function findByCriteria(array $criteria)
    {
        return $this->model->where($criteria)->first();
    }
}
