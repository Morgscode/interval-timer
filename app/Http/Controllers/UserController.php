<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
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

    public function update(Request $request)
    {
        $updated_user = $request->validate([
            'name' => 'nullable|max:50',
            'email' => 'nullable|unique:users|email',
            'gender' => 'nullable|max:5',
            'birth_date' => 'nullable',
            'height' => 'nullable|max:300',
            'weight' => 'nullable'
        ]);
        
        $user = auth()->user();

        if (is_null($updated_user['email'])) {
            $updated_user['email'] = $user->email;
        }

        $saved_user_profile = User::where('id', $user->id)->update(
            $updated_user
        );

        if ( ! $request->expectsJson() ) {
            return view('dashboard', ['user' => $saved_user_profile]);
        } else {
            return $saved_user_profile;
        }
    }

    public function validateNewUser(Request $request)
    {
        $valid_user = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        return $valid_user;
    }
}
