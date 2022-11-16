<?php

namespace App\Http\Repositories\SavePost;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\SavePost;

class SavePostRepositoryImplement extends Eloquent implements SavePostRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(SavePost $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
