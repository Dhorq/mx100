<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
     public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
            'status'      => 'in:draft,published',
        ]);

        $job = $request->user()->jobs()->create($validated);
        return response()->json($job, 201);
    }

    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $job->update($request->only(['title', 'description', 'status']));
        return response()->json($job);
    }

    public function index()
    {
        $jobs = Job::where('status', 'published')->get();
        return response()->json($jobs);
    }

    public function myJobs(Request $request)
    {
        return response()->json($request->user()->jobs);
    }
}