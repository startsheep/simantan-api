<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(LoginRequest $request)
    {
        $user = $this->userService->whereNip($request->nip);

        if (! $user) {
            return response()->json([
                'message' => 'nip or password wrong!',
            ], 400);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'nip or password wrong!',
            ], 400);
        }

        $role = strtolower($user->role->name);

        $token = $user->createToken('api', [$role]);

        Auth::login($user);

        return response()->json([
            'message' => 'Login success!',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nip' => $user->nip,
                    'image' => $user->image,
                ],
                'token' => $token->plainTextToken,
            ],
        ]);
    }
}
