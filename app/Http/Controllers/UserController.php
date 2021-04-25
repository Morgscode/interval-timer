<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{

    public function __construct(User $user_model)
    {
        $this->user_model = $user_model;
    }
    /**
     * 
     * This is used to create users via the api, 
     * for web auth - see:
     * App/Http/Controllers/Auth/RegisteredUserController.php
     * 
     */
    public function store(Request $request)
    {
        $new_user = $this->user_model->validateNewUser($request);
        
        $user = User::create([
            'email' => $new_user['email'],
            'password' => bcrypt($new_user['password'])
        ]);

        $user->sendEmailVerificationNotification();

        $response = [
            'status' => 'success',
            'data' => [
                'status_code' => 201,
                'message' => 'You\'ve been sent an email to verify your email address. you\'ll need to verify your email address to use this service',
            ]
        ];

        return response($response, 201);
    }

    public function show(User $user)
    {
        return [
            'status' => 'success',
            'data' => [
                'user' => $user
                ]
            ];
    }

    public function update(Request $request)
    {
        $updated_user = $this->user_model->validateUpdatedUser($request);
        
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
            return [
                'status' => 'success',
                'data' => [
                    'user' => $saved_user_profile
                    ]
                ];
        }
    }
}
