<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostDetail;
use App\Http\Searches\PostSearch;
use App\Http\Services\Post\PostService;
use App\Http\Services\SavePost\SavePostService;
use App\Http\Traits\ErrorFixer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use ErrorFixer;

    /**
     * @var
     */
    protected $postService;

    /**
     * @var
     */
    protected $savePostService;

    /**
     * @param  PostService  $postService
     * @param  SavePostService  $savePostService
     */
    public function __construct(PostService $postService, SavePostService $savePostService)
    {
        $this->postService = $postService;
        $this->savePostService = $savePostService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $factory = app()->make(PostSearch::class);
        $posts = $factory->apply()->orderBy('id', 'desc')->paginate($request->per_page);

        return new PostCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Post\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->postService->create($request->all());
        } catch (Exception $e) {
            DB::rollBack();

            return $this->createError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->findOrFail($id);

        return new PostDetail($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Post\UpdatePostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->postService->update($id, $request->all());
        } catch (Exception $e) {
            DB::rollBack();

            return $this->updateError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->postService->delete($id);
    }

    public function like(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->postService->updateLike($id, $request->all());
        } catch (Exception $e) {
            DB::rollBack();

            return $this->updateError();
        }
    }

    public function likeCount($id)
    {
        $result = $this->postService->countLike($id);

        return $result;
    }

    public function save($id)
    {
        dd($id);
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->savePostService->save($id);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->createError();
        }
    }
}
