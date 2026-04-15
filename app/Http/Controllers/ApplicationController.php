<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
     public function store(Request $request, Job $job)
    {
        if ($job->status !== 'published') {
            return response()->json(['message' => 'Job not available'], 422);
        }

        $exists = Application::where('job_id', $job->id)
                              ->where('user_id', $request->user()->id)
                              ->exists();
        if ($exists) {
            return response()->json(['message' => 'Already applied'], 422);
        }

        $request->validate(['cv' => 'required|file|mimes:pdf,doc,docx|max:2048']);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $application = Application::create([
            'job_id'  => $job->id,
            'user_id' => $request->user()->id,
            'cv_path' => $cvPath,
        ]);

        return response()->json($application, 201);
    }

    public function index(Request $request, Job $job)
    {
        if ($job->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $applications = $job->applications()->with('freelancer')->get();
        return response()->json($applications);
    }
}