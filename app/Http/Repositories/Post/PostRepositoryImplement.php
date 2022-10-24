<?php

namespace App\Http\Repositories\Post;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Post;
use Illuminate\Http\Request;

class PostRepositoryImplement extends Eloquent implements PostRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function httpSearch(Request $request)
    {
        $query = $this->model;
        $query = $this->searches($request);
        $query = $query->paginate($request->per_page);

        return $query;
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

    protected function searches($request)
    {
        $query = $this->model;

        if ($request->user) {
            $query = $this->searchByUser($request->user);
        }

        if ($request->flag) {
            $query = $this->searchByFlag($request->flag);
        }

        return $query;
    }

    protected function searchByUser($userId)
    {
        return $this->model->whereHas('user', function ($user) use ($userId) {
            $user->where('id', $userId);
        });
    }

    protected function searchByFlag($flagId)
    {
        return $this->model->whereHas('flag', function ($flag) use ($flagId) {
            $flag->where('id', $flagId);
        });
    }
}
