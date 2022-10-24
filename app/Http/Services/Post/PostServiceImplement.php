<?php

namespace App\Http\Services\Post;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Post\PostRepository;
use App\Http\Traits\FIllableFixer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostServiceImplement extends Service implements PostService
{
    use FIllableFixer;
    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(PostRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function httpSearch(Request $request)
    {
        return $this->mainRepository->httpSearch($request);
    }

    public function create($attributes)
    {
        if ($attributes['user_id'] == null) {
            $attributes['user_id'] = auth()->user()->id;
        }

        if (isset($attributes['image'])) {
            if (isset($attributes['image']) && $attributes['image']) {
                $attributes['image'] = $attributes['image']->store('posts');
            }
        }

        $post = $this->mainRepository->create($attributes);

        return response()->json([
            'message' => 'post has added!',
            'status' => 'success',
            'data' => $post
        ], Response::HTTP_CREATED);
    }

    public function update($id, $attributes)
    {
        $post = $this->mainRepository->findOrFail($id);

        if (isset($attributes['image'])) {
            if (isset($attributes['image']) && $attributes['image']) {
                if ($post->image != null) {
                    Storage::delete($post->image);
                }
                $attributes['image'] = $attributes['image']->store('posts');
            }
        }

        $post = $post->update($attributes);

        return response()->json([
            'message' => 'post has updated!',
            'status' => 'success',
            'data' => $post
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $post = $this->mainRepository->findOrFail($id);

        if ($post->image != null) {
            Storage::delete($post->image);
        }

        $post->delete();

        return response()->json([
            'message' => 'post has deleted!',
            'status' => 'success',
            'data' => $post
        ], Response::HTTP_OK);
    }
}
