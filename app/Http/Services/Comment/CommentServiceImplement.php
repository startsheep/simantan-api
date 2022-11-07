<?php

namespace App\Http\Services\Comment;

use App\Http\Repositories\Comment\CommentRepository;
use Illuminate\Http\Response;
use LaravelEasyRepository\Service;

class CommentServiceImplement extends Service implements CommentService
{
    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(CommentRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($attributes)
    {
        $comment = parent::create($attributes);

        return response()->json([
            'message' => 'comment has added!',
            'status' => 'success',
            'data' => $comment,
        ], Response::HTTP_CREATED);
    }

    public function update($id, $attributes)
    {
        $comment = parent::findOrFail($id);

        $comment->update($attributes);

        return response()->json([
            'message' => 'comment has updated!',
            'status' => 'success',
            'data' => $comment,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $comment = parent::findOrFail($id);

        $comment->delete();

        return response()->json([
            'message' => 'post has deleted!',
            'status' => 'success',
            'data' => $comment,
        ], Response::HTTP_OK);
    }
}
