<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:employer')->group(function () {
        Route::post('/jobs',              [JobController::class, 'store']);
        Route::put('/jobs/{job}',         [JobController::class, 'update']);
        Route::get('/my-jobs',            [JobController::class, 'myJobs']);
        Route::get('/jobs/{job}/applicants', [ApplicationController::class, 'index']);
    });

    Route::middleware('role:freelancer')->group(function () {
        Route::get('/jobs',               [JobController::class, 'index']);
        Route::post('/jobs/{job}/apply',  [ApplicationController::class, 'store']);
    });
});