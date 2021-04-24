<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interval;

class IntervalController extends Controller
{

    public function __construct(Interval $interval_model)
    {   
        $this->interval_model = $interval_model;
    }

    public function store(Request $request, $id)
    {
        $this->interval_model->validateNewInterval($request);

        $interval = Interval::create(
            $this->interval_model->prepareNewInterval($request, $id)
        );

        return $interval;
    }
}
