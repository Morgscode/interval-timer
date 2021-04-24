<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * 
     * This is used to create users via the api, 
     * for web auth - see:
     * App/Http/Controllers/Auth/RegisteredUserController.php
     * 
     */
    public function store(Request $request)
    {
        $new_user = $this->validateNewUser($request);
        
        $user = User::create([
            'email' => $new_user['email'],
            'password' => bcrypt($new_user['password'])
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
            'name' => 'nullable|string|max:50',
            'email' => 'nullable|string|unique:users|email',
            'gender' => 'nullable|string|max:6',
            'birth_date' => 'nullable|date',
            'height' => 'nullable|numeric|max:500',
            'weight' => 'nullable|numeric|max:750'
        ]);
        
        $user = auth()->user();

        if ( is_null( $updated_user['email'] ) ) {
            $updated_user['email'] = $user->email;
        }

        $saved_user_profile = User::where( 'id' , $user->id )->update(
            $updated_user
        );

        if ( ! $request->expectsJson() ) {
            return redirect()->route('dashboard', ['user' => $user]);
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
