<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imtigger\LaravelJobStatus\JobStatus;
use Settings;

class JobStatusController extends Controller
{
    public function index()
    {
        $jobStatus = JobStatus::latest()->paginate(Settings('app_pagination'));
        return view('operator.jobstatus_index', [
            'jobStatus' => $jobStatus,
            'title' => 'BUAT TAGIHAN',
            'routePrefix' => 'jobstatus'
        ]);
    }

    public function show($id)
    {
        $job = JobStatus::findOrFail($id);
        $data = [
            'id' => $job->id,
            'porgress_now' => $job->progress_now,
            'progress_max' => $job->progress_max,
            'is_ended' => $job->is_ended,
            'progress_percentage' => $job->progress_percentage,
        ];
        return response()->json($data, 200);
    }
}
