<?php

namespace App\Http\Services\User;

use App\Http\Repositories\User\UserRepository;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use LaravelEasyRepository\Service;

class UserServiceImplement extends Service implements UserService
{
    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function whereNip($nip)
    {
        return $this->mainRepository->whereNip($nip);
    }

    public function create($attributes)
    {
        if (!isset($attributes['role_id'])) {
            $attributes['role_id'] = Role::EMPLOYEE;
        }

        $attributes['active'] = User::ACTIVE;
        $attributes['password'] = 'password';
        $attributes['image'] = $attributes['image']->store('users');

        $user = parent::create($attributes);

        return response()->json([
            'message' => 'user has added!',
            'status' => 'success',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    public function update($id, $attributes)
    {
        $user = parent::findOrFail($id);

        if (isset($attributes['image'])) {
            if (isset($attributes['image']) && $attributes['image']) {
                Storage::delete($user->image);

                $attributes['image'] = $attributes['image']->store('users');
            }
        }

        $user = $user->update($attributes);

        return response()->json([
            'message' => 'user has updated!',
            'status' => 'success',
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $user = parent::findOrFail($id);

        Storage::delete($user->image);

        $user->delete();

        return response()->json([
            'message' => 'user has deleted!',
            'status' => 'success',
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function changePassword($id, $attributes)
    {
        $user = parent::findOrFail($id);

        if (!Hash::check($attributes['old_password'], $user->password)) {
            return response()->json([
                'meta' => [
                    'messages' => [
                        'old_password' => ['The password is wrong.']
                    ],
                    'status_code' => 400,
                ],
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->update([
            'password' => $attributes['new_password']
        ]);

        return response()->json([
            'message' => 'user has update password!',
            'status' => 'success',
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function countPost($id)
    {
        $countPost = $this->mainRepository->countPost($id);

        return response()->json([
            'message' => 'Success!',
            'status' => 'success',
            'data' => $countPost,
        ], Response::HTTP_OK);
    }

    public function countLike($id)
    {
        $countLike = $this->mainRepository->countLike($id);

        return response()->json([
            'message' => 'Success!',
            'status' => 'success',
            'data' => $countLike,
        ], Response::HTTP_OK);
    }
}
