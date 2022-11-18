<?php

namespace App\Http\Services\SavePost;

use App\Http\Repositories\Post\PostRepository;
use LaravelEasyRepository\Service;
use App\Http\Repositories\SavePost\SavePostRepository;
use Illuminate\Http\Response;

class SavePostServiceImplement extends Service implements SavePostService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;
    protected $postRepository;

    public function __construct(SavePostRepository $mainRepository, PostRepository $postRepository)
    {
        $this->mainRepository = $mainRepository;
        $this->postRepository = $postRepository;
    }

    public function save($id)
    {
        $post = $this->postRepository->findOrFail($id);
        if (!$post) {
            return response()->json([
                'message' => 'Fail, sorry post data not found!',
            ], 400);
        }

        $savePost = $this->mainRepository->findByCriteria([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]);

        if ($savePost) {
            $savePost->delete();
            $message = 'post has removed from stash!';
        } else {
            $savePost = parent::create([
                'post_id' => $post->id,
                'user_id' => auth()->user()->id
            ]);
            $message = 'post has saved!';
        }

        return response()->json([
            'message' => $message,
            'status' => 'success',
            'data' => $savePost,
        ], Response::HTTP_OK);
    }
}
