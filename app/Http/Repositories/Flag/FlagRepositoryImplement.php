<?php

namespace App\Http\Repositories\Flag;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Flag;

class FlagRepositoryImplement extends Eloquent implements FlagRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Flag $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
