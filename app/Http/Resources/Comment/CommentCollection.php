<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
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

        foreach ($this as $comment) {
            $result[] = [
                "id" => $comment->id,
                "post" => $comment->post,
                "user" => $comment->user,
                "message" => $comment->message,
                "created_at" => $comment->created_at,
                "updated_at" => $comment->updated_at
            ];
        }

        return $result;
    }
}
