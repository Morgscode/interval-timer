<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ApiEmailVerificationNotificationController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $valid_user = $this->validateNewUser($request);
        
        $user = User::create([
            'email' => $valid_user['email'],
            'password' => bcrypt($valid_user['password'])
        ]);

        $user->sendEmailVerificationNotification();

        $response = [
            'status' => 'success - user created',
            'status_code' => 201,
            'message' => 'You\'ve been sent an email to verify your email address. you\'ll need to verify your email address to use this service'
        ];

        return response($response, 201);
    }

    public function validateNewUser(Request $request)
    {
        $valid_user = $request->validate([
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        return $valid_user;
    }
}
