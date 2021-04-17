<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $user_login = $this->validateLoginCredentials($request);

        $user = User::where('email', $user_login['email'])->firstOrFail();

         //check password
         if ( ! $user || ! Hash::check($user_login['password'], $user['password'])) :
            return response([
                'message' => 'incorrect login credentials',
                'status_code' => 401
            ], 401);
        endif;

        // check if user has verified ttheir email address
        if ($user->hasVerifiedEmail()) {

            $token = $user->createToken('ItApiAccessToken');
        
            return [
                'user' => $user,
                'token' => $token->plainTextToken
            ];

        } else {

            return [
                'status' => 'Not Authorized',
                'status_code' => 401,
                'message' => 'Please verify your email address before ussing this service'
            ];
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Successfully logged out',
            'status_code' => 200
        ];
    }

    public function validateLoginCredentials(Request $request)
    {
        $valid_login_attempt = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        return $valid_login_attempt;
    }
}
