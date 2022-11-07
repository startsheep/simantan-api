<?php

namespace App\Http\Services\Like;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Like\LikeRepository;
use Illuminate\Http\Response;

class LikeServiceImplement extends Service implements LikeService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(LikeRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function update($id, $attributes)
    {
        $like = $this->mainRepository->updateLike($id);

        return response()->json([
            'message' => 'like has updated!',
            'status' => 'success',
            'data' => $like,
        ], Response::HTTP_OK);
    }

    public function findOrFail($id)
    {
        $likeCount = $this->mainRepository->likeCount($id);

        return response()->json([
            'message' => 'Success!',
            'status' => 'success',
            'data' => $likeCount,
        ], Response::HTTP_OK);
    }
}
