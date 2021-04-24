<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interval;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class IntervalController extends Controller
{

    public function __construct(Interval $interval_model)
    {   
        $this->interval_model = $interval_model;
    }

    public function index(Request $request, int $user)
    {
        return User::find($user)->intervals;
    }

    public function show(Request $request, int $user_id, int $interval_id)
    {
        return Interval::where('id', $interval_id)->firstOrFail();
    }

    public function store(Request $request, int $user)
    {
        $this->interval_model->validateNewInterval($request);

        $interval = Interval::create(
            $this->interval_model->prepareNewInterval($request, $user)
        );

        return $interval;
    }

    public function update(Request $request, int $user_ud, int $interval_id)
    {
        
    }

    public function destroy(Request $request, int $user_id, int $interval_id)
    {
       $interval = Interval::find($interval_id);
       return $interval->delete();
    }
}
