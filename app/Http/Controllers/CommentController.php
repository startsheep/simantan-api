<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentDetail;
use App\Http\Searches\CommentSearch;
use App\Http\Services\Comment\CommentService;
use App\Http\Traits\ErrorFixer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    use ErrorFixer;

    /**
     * @var
     */
    protected $commentService;

    /**
     * @param  CommentService  $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $factory = app()->make(CommentSearch::class);
        $comments = $factory->apply()->paginate($request->per_page);

        return new CommentCollection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Comment\CreateCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->commentService->create($request->all());
        } catch (Exception $th) {
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
        $comment = $this->commentService->findOrFail($id);

        return new CommentDetail($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Comment\UpdateCommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->commentService->update($id, $request->all());
        } catch (Exception $th) {
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
        return $this->commentService->delete($id);
    }
}
