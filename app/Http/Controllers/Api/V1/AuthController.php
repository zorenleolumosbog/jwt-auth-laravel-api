<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginUserRequest;
use App\Http\Requests\V1\RegisterUserRequest;
use App\Http\Resources\V1\UserLoginTokenResource;
use App\Http\Resources\V1\UserRefreshResource;
use App\Http\Resources\V1\UserRegisterTokenResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request) {        
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ip_addr' => $request->ip_addr,
            'date_submitted' => $request->date_submitted
        ]);

        return new UserRegisterTokenResource($user);
    }

    public function logout() {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function login(LoginUserRequest $request) {
        $user = User::where('email', $request->email)->first();

        if( !Hash::check($request->password, $user->password) ) {
            $message = 'The selected password is invalid.';

            return response()->json([
                'status' => 'errors',
                'message' => $message,
                'errors' => [
                    'password' => $message
                ]
            ]);
        }

        return new UserLoginTokenResource($user);
    }

    public function refresh()
    {
        return new UserRefreshResource(Auth::user());
    }
}
