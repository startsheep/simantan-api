<?php

namespace App\Http\Traits;

/**
 * FIllableFixer
 */
trait FIllableFixer
{
    protected function onlyFillables($attributes = []): array
    {
        $attributeFillables = [];
        $fillables = $this->mainRepository->getFillable();

        foreach ($fillables as $fillable) {
            $attributeFillables[$fillable] = $attributes[$fillable];
        }

        return $attributeFillables;
    }
}
