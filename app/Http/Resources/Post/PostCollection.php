<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [];

        foreach ($this as $post) {
            $result[] = [
                'id' => $post->id,
                'image' => $post->image,
                'description' => $post->description,
                'flag' => $post->flag,
                'user' => $post->user,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
            ];
        }

        return $result;
    }
}
