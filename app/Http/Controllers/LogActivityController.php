<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        $log = Activity::latest()->paginate(Settings('app_paginate'));
        return view('operator.logactivity_index', [
            'models' => $log,
            'title' => 'AKTIVITAS USER',
        ]);
    }
}
