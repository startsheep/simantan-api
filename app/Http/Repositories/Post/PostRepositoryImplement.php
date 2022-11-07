<?php

namespace App\Http\Repositories\Post;

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

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }
}
