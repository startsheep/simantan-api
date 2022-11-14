<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserDetail;
use App\Http\Searches\UserSearch;
use App\Http\Services\User\UserService;
use App\Http\Traits\ErrorFixer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use ErrorFixer;

    /**
     * @var
     */
    protected $userService;

    /**
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $factory = app()->make(UserSearch::class);
        $users = $factory->apply()->paginate($request->per_page);

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->userService->create($request->all());
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
        $post = $this->userService->findOrFail($id);

        return new UserDetail($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->userService->update($id, $request->all());
        } catch (Exception $e) {
            DB::rollBack();

            return $this->updateError();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdatePasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UpdatePasswordRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            return $this->userService->changePassword($id, $request->all());
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
        return $this->userService->delete($id);
    }
}
