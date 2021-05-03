<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\User;

class SessionController extends Controller
{
    public function __construct(Session $session_model)
    {
        $this->session_model = $session_model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $user)
    {
        $sessions = User::find($user)->sessions;

        return [
            'status' => 'success',
            'data' => [
                'sessions' => $sessions
                ]
            ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $user)
    {
        $this->session_model->validateSessionData($request);

        $session = Session::create(
            $this->session_model->prepareSessionDataForDB($request, $user)
        );

        return $session;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $user_id, int $session_id)
    {
        $session = Session::where('id', $session_id)->firstOrFail();

        return [
            'status' => 'success',
            'data' => [
                'session' => $session
                ]
            ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $user_id ,int $session_id)
    {
        $this->session_model->validateSessionData($request);

        $session = Session::where('id', $session_id)->firstOrFail();

        $session->update(
            $this->session_model->prepareSessionDataForDB($request, $user_id)
        );

        return [
            'status' => 'success',
            'data' => [
                'session' => $session
                ]
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $user_id ,int $session_id)
    {
        $session = Session::find($session_id);
        $session->delete();
 
        return [
            'status' => 'success',
            'data' => null
        ];
    }
}
