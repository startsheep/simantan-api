<?php

namespace App\Http\Controllers;

use App\Http\Resources\Like\LikeCollection;
use App\Http\Searches\LikeSearch;
use App\Http\Services\Like\LikeService;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * @var
     */
    protected $likeService;

    /**
     * @param  LikeService  $likeService
     */
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $factory = app()->make(LikeSearch::class);
        $likes = $factory->apply()->paginate($request->per_page);

        return new LikeCollection($likes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        // $result = DB::transaction(function ($request, $id) {
        return $this->likeService->update($id, $request->all());
        // });

        // return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->likeService->findOrFail($id);

        return $result;
    }
}
