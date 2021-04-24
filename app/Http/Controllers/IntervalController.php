<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interval;
use App\Models\User;


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
        $this->interval_model->validateIntervalData($request);

        $interval = Interval::create(
            $this->interval_model->prepareIntervalDataForDB($request, $user)
        );

        return $interval;
    }

    public function update(Request $request, int $user_id, int $interval_id)
    {
        $this->interval_model->validateIntervalData($request);

        $interval = Interval::where('id', $interval_id)->update(
            $this->interval_model->prepareIntervalDataForDB($request, $user_id)
        );

        return $interval;
    }

    public function destroy(Request $request, int $user_id, int $interval_id)
    {
       $interval = Interval::find($interval_id);
       return $interval->delete();
    }
}
