<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait NameSpaceFixer
{
    protected function getBaseDirectory($factoryName)
    {
        return File::dirname($this->basePath.'\\'.$factoryName);
    }

    protected function getBaseFileName($factoryName)
    {
        return class_basename(Str::ucfirst($factoryName));
    }

    protected function getNameSpacePath($factoryName)
    {
        $chunks = explode('\\', $factoryName);
        $fileName = collect($chunks)->last();

        return Str::ucfirst(str_replace('\\'.$fileName, '', $factoryName));
    }

    protected function getNameSpace($factoryName)
    {
        return str_replace('/', '\\', $factoryName);
    }
}
