<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutomaticAttendanceRegisterRequest;
use App\Jobs\AutomaticAttendanceJob;
use App\Models\AutomaticAttendance;
use Carbon\Carbon;

class AutomaticAttendanceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register(AutomaticAttendanceRegisterRequest $request)
    {
        AutomaticAttendance::create($request->all());

        return back()->with('success', 'Registration Successful!');
    }
}
